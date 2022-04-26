<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $member = new Member();
        $member->name = "Reza Nurfachmi";
        $member->gender = "L";
        $member->phone_number = "081287411747";
        $member->address = "Tangerang";
        $member->email = "aaezha@gmail.com";
        $member->save();

        $member->user()->create([
            'name' => 'Reza Nurfachmi',
            'email' => 'aaezha@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);
    }
}
