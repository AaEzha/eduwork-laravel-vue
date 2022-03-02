<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' => 'admin123',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' =>
                '$2y$10$7EnPzQDsqonJNmFp14lB7e8kWtJbX0G9CBTbtbQLIsnJLNFNJnzLq', // password,,
                'remember_token' => now(),
                'member_id' => rand(1, 20),
            ],
            [
                'name' => 'Gusti',
                'email' => 'gusti12@gmail.com',
                'email_verified_at' => now(),
                'password' => '$2y$10$7EnPzQDsqonJNmFp14lB7e8kWtJbX0G9CBTbtbQLIsnJLNFNJnzLq', // password,
                'remember_token' => now(),
                
                'member_id' => rand(1,2),
            ],

        ];
        DB::table('users')->insert($user);
    }
}