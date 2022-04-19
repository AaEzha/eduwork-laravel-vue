<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
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
        $array = ['W', 'M'];
        $random = Arr::random($array);

        for ($i = 0; $i < 40; $i++) {

            $member = new Member;
            $member->name = $faker->name;
            $member->gender = $random;
            $member->phone_number = '0821' . $faker->randomNumber(8);
            $member->address = $faker->address;
            $member->email = $faker->email;

            $member->save();
        }
    }
}
