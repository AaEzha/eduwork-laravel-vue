<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i=0; $i < 20; $i++) {

            $author = new Author;

            $author->name = $faker->name;
            $author->email = $faker->email;
            $author->phone_number = '0821'.$faker->randomNumber(8);
            $author->address = $faker->address;

            $author->save();
        }
    }
}
