<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('cities')->delete();

        DB::table('cities')->insert([
            0 =>
                [
                    'id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'seattle',
                    'name' => 'Seattle',
                ],
            1 =>
                [
                    'id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'bellevue',
                    'name' => 'Bellevue',
                ],
            2 =>
                [
                    'id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'renton',
                    'name' => 'Renton',
                ],
            3 =>
                [
                    'id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'tacoma',
                    'name' => 'Tacoma',
                ],
            4 =>
                [
                    'id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'kirkland',
                    'name' => 'Kirkland',
                ],
            5 =>
                [
                    'id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'kent',
                    'name' => 'Kent',
                ],
            6 =>
                [
                    'id' => 7,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'everett',
                    'name' => 'Everett',
                ],
            7 =>
                [
                    'id' => 8,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'slug' => 'spokane',
                    'name' => 'Spokane',
                ],
        ]);


    }
}
