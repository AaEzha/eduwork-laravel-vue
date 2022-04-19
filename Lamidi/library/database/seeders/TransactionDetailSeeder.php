<?php

namespace Database\Seeders;

use App\Models\TransactionDetail;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionDetailSeeder extends Seeder
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

            $transaction_detail = new TransactionDetail;
            $transaction_detail->transaction_id = rand(1, 20);
            $transaction_detail->book_id = rand(1, 20);
            $transaction_detail->qty = rand(1, 5);

            $transaction_detail->save();
        }
    }
}
