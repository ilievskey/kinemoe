<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                // 'profile_picture' => 'pfp here',
                'user_role' => 1,
                'email' => 'admin@admin.com',
                'password' => Hash::make('adminadmin')
            ],
            [
                'name' => 'Rainbow Six',
                // 'profile_picture' => 'pfp here',
                'user_role' => 4,
                'email' => 'rainbow@six.com',
                'password' => Hash::make('rainbow6')
            ],
            [
                'name' => 'Tom Clancy',
                // 'profile_picture' => 'pfp here',
                'user_role' => 4,
                'email' => 'tom@clancy.com',
                'password' => Hash::make('tomclancy')
            ],
        ]);
    }
}
