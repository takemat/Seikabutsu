<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image_url',
    ];
    
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::withCount('likes')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }
    public function isLikedBy($user): bool {
        return Like::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }
    // Commentに対するリレーション
    
    //「1対多」の関係なので'comments'と複数形に
    public function comments()   
    {
        return $this->hasMany(Comment::class);  
    }
}