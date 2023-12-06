<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
                'name' => '東京のAさん',
                'email' => 'a@e',
                'password' => Hash::make('password'),
                
         ],
         [
                'name' => '神奈川のBさん',
                'email' => 'b@e',
                'password' => Hash::make('password'),
                
         ],
         [
                'name' => '大阪のCさん',
                'email' => 'c@e',
                'password' => Hash::make('password'),
                
         ],
         );
    }
}
