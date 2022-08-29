<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('categories')->delete();

        DB::table('categories')->insert([
            0 =>
                [
                    'id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'jobs',
                    'name' => 'Jobs',
                    'price_field_available' => false,
                ],
            1 =>
                [
                    'id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'realty',
                    'name' => 'Realty',
                    'price_field_available' => true,
                ],
            2 =>
                [
                    'id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'rent',
                    'name' => 'Rent',
                    'price_field_available' => true,
                ],
            3 =>
                [
                    'id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'for-sale',
                    'name' => 'For Sale',
                    'price_field_available' => true,
                ],
            4 =>
                [
                    'id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'services',
                    'name' => 'Services',
                    'price_field_available' => false,
                ],
        ]);


    }
}
