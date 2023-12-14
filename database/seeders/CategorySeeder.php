<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => '関東'
        ]);
        DB::table('categories')->insert([
            'name' => '中部'
        ]);
        DB::table('categories')->insert([
            'name' => '近畿'
        ]);
        DB::table('categories')->insert([
            'name' => '四国'
        ]);
    }
}
