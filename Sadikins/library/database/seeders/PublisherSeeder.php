<?php

namespace Database\Seeders;


use App\Models\Publisher;
use Faker\Factory as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {

            $publisher = new Publisher;

            $publisher->name = $faker->name;
            $publisher->email = $faker->email;
            $publisher->phone_number = '081' . $faker->randomNumber(8);
            $publisher->address = rand(1, 20);

            $publisher->save();
        }
    }
}
