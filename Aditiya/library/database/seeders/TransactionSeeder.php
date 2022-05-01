<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     *
     */
    public function run()
    {
        $faker = Faker::create();

        $year = rand(2020, 2022);
        $month = rand(1, 12);
        $day = rand(1, 28);
        // $date = ($year, $month, $day);

        for ($i = 0; $i < 20; $i++) {

            $transaction = new Transaction;
            $transaction->member_id = rand(1, 20);
            $transaction->date_start = $faker->date();
            $transaction->date_end = $faker->date();

            $transaction->save();
        }
    }
}