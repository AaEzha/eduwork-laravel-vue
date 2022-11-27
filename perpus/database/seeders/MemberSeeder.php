<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        for($i=0; $i < 20; $i++){
            $member = new Member();

            $member->name = $faker->name;
            $member->gender = $faker->randomElement(['male', 'female']);
            $member->phone_number = '082' . $faker->randomNumber(9);
            $member->address = $faker->address;
            $member->email = $faker->email;

            $member->save();
        }
    }
}
