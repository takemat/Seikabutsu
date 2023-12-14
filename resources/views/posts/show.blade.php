<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1 class="title">
            {{ $post->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $post->body }}</p>    
            </div>
            <div>
            <img src="{{ $post->image_url }}" alt="画像が読み込めません。"/>
            </div>
            <form method="post" action="{{ route('comments.store') }}">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <textarea name="body" required></textarea>
            <button type="submit">コメントする</button>
            </form>
            
            @foreach ($post->comments as $comment)
                <p>{{ $comment->body }}</p>
            @endforeach
            
        </div>
        <div class="edit"><a href="/posts/{{ $post->id }}/edit">edit</a></div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
        <a href="">{{ $post->category->name }}</a>
        <div id="map" style="height:500px"></div>
    </body>
    

        

         
        <script>
            function initMap() {
                // マップの表示部分を取得
                map = document.getElementById("map");
        
                // Postの緯度、経度を変数に入れる
                let postLocation = {lat: {{ $post->latitude }}, lng: {{ $post->longitude }}};
        console.log(postLocation);
                // オプションの設定
                opt = {
                    // 地図の縮尺を指定
                    zoom: 13,
                    // センターをPostの位置に指定
                    center: postLocation,
                };
        
                // 地図のインスタンスを作成（第一引数にはマップを描画する領域、第二引数にはオプションを指定）
                mapObj = new google.maps.Map(map, opt);
        
                // マーカーを設定
                marker = new google.maps.Marker({
                    // ピンを差す位置をPostの位置に設定
                    position: postLocation,
                    // ピンを差すマップを指定
                    map: mapObj,
                    // ホバーしたときにPostのタイトルを表示
                    title: '{{ $post->title }}',
                });
            }
        </script>

        <!--// Google Maps APIの読み込み（keyには自分のAPI_KEYを指定）-->
        <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{$api_key}}&callback=initMap" async defer></script>
</html>