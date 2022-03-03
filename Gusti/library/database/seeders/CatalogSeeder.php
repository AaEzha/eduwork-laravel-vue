<?php

namespace Database\Seeders;

use App\Models\Catalog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = [
            [
                'name' => 'Education',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Web Programming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile Programming',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'For Kids',
                'created_at' => now(),
                'updated_at' => now(),
            ],
       ];
        DB::table('catalogs')->insert($catalogs);
    }
}    
    // $faker = Faker::create();

        // for ($i=0; $i < 4; $i++) { 
        //     $catalog = new Catalog;

        //     $catalog->name = $faker-> name;

        //     $catalog->save();
        // }
    
