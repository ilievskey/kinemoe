<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['genre_name' => 'Drama'],
            ['genre_name' => 'Action'],
            ['genre_name' => 'Romance'],
            ['genre_name' => 'Comedy'],
            ['genre_name' => 'Fantasy'],
            ['genre_name' => 'Horror'],
            ['genre_name' => 'Thriller'],
            ['genre_name' => 'Musical'],
            ['genre_name' => 'History'],
            ['genre_name' => 'Documentary'],
        ]);
    }
}
