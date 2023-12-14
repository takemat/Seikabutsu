<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\PostRequest; 
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Cloudinary;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post)
    {
        $rankings = Post::withCount('likes')->orderBy("likes_count","DESC")->limit(5)->get();
        return view('posts.index')->with(['rankings'=>$rankings,'posts' => $post->getPaginateByLimit()]);
    }

    public function show(Post $post)
    {   
        $api_key = config('app.api_key');
    
        return view('posts.show')->with(['post' => $post, 'api_key' => $api_key]);
    }

    public function create(Category $category)
    {
        return view('posts.create')->with(['categories' => $category->get()]);
    }

    public function store(Post $post, PostRequest $request) // 引数をRequestからPostRequestにする
    {
        $image_url = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $post->user_id = \Auth::id();
        $input = $request['post'];
        $input += ['image_url' => $image_url];
        
        $apiKey = config('app.api_key');
                $search = $request['name'];  // 検索ワードを設定
        
        // Google Places APIのURLを構築
        $url = sprintf(
            "https://maps.googleapis.com/maps/api/place/textsearch/json?query=%s&key=%s",
            urlencode($search),
            $apiKey
        );
        
        // cURLを使用してAPIリクエストを送信
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        
        // JSONレスポンスを配列にデコード
        $places = json_decode($response, true)['results'];
        $place = $places[0];
        $post->latitude=$place['geometry']['location']['lat'];
        $post->longitude=$place['geometry']['location']['lng'];
        
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    public function edit(Post $post)
{
    return view('posts.edit')->with(['post' => $post]);
}
public function update(PostRequest $request, Post $post)
{
    $input_post = $request['post'];
    $post->fill($input_post)->save();

    return redirect('/posts/' . $post->id);
}
public function delete(Post $post)
{
    $post->delete();
    return redirect('/');
}
public function like(Request $request)
{
    $user_id = Auth::user()->id; // ログインしているユーザーのidを取得
    $post_id = $request->post_id; // 投稿のidを取得

    // すでにいいねがされているか判定するためにlikesテーブルから1件取得
    $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); 

    if (!$already_liked) { 
        $like = new Like; // Likeクラスのインスタンスを作成
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->save();
    } else {
        // 既にいいねしてたらdelete 
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    // 投稿のいいね数を取得
    $post_likes_count = Post::withCount('likes')->findOrFail($post_id)->likes_count;
    $param = [
        'post_likes_count' => $post_likes_count,
    ];
    return response()->json($param); // JSONデータをjQueryに返す
    }
        
    }