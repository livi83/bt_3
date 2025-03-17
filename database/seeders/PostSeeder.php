<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            ['title' => 'Prvý článok', 'content' => 'Obsah prvého článku', 
            'user_id' => 1, 'category_id' => 1],
            
            ['title' => 'Druhý článok', 'content' => 'Obsah druhého článku', 
            'user_id' => 2, 'category_id' => 2]
        ]);
    }
}
