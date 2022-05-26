<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $catalog = collect(['Education', 'Religious', 'Business', 'Programming', 'Psychology']);
        $catalog->each(function ($c) {
            Catalog::create([
                'name' => $c

            ]);
        });
    }
}
