<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
                'title' => '観光の楽しさを一緒に共有しよう！',
                'body' => '紹介したい観光地は．．．？',
                'image_url' => 'https://res-console.cloudinary.com/dn9pkbrzd/thumbnails/v1/image/upload/v1700733875/bmZwcTd0d2ZlNmZwa21vaWgybmc=/preview',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1,
                'category_id' => 1,
         ],
         [
                'title' => '観光を共有しよう！',
                'body' => '紹介したい観光地',
                'image_url' => 'https://res-console.cloudinary.com/dn9pkbrzd/thumbnails/v1/image/upload/v1700733875/bmZwcTd0d2ZlNmZwa21vaWgybmc=/preview',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 2,
                'category_id' => 1,
         ],
         [
                'title' => '一緒に共有しよう！',
                'body' => '紹介したい観光地は！',
                'image_url' => 'https://res-console.cloudinary.com/dn9pkbrzd/thumbnails/v1/image/upload/v1700733875/bmZwcTd0d2ZlNmZwa21vaWgybmc=/preview',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'user_id' => 1,
                'category_id' => 2,
         ],
         );
    }
}
