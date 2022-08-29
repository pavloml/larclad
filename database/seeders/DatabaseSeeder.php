<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            ['name' => 'Administrator',
                'username' => 'admin',
                'email' => config('mail.from.address'),
                'email_verified_at' => now(),
                'password' => Hash::make('CHANG3_me_IMM3DIAT3LY'),
                'phone' => '+12060000000',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()]);

        $this->call([
            CitiesSeeder::class,
            CategoriesSeeder::class,
            SubcategoriesSeeder::class
        ]);
    }
}
