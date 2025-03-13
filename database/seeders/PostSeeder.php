<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class PostSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'My first post',
                'content' => 'My first content',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'My second post',
                'content' => 'My second content',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
