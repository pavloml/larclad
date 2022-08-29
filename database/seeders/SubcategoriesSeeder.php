<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategoriesSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('subcategories')->delete();

        DB::table('subcategories')->insert([
            0 =>
                [
                    'id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'cars',
                    'name' => 'Cars',
                ],
            1 =>
                [
                    'id' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'computers',
                    'name' => 'Computers',
                ],
            2 =>
                [
                    'id' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 1,
                    'slug' => 'apartments',
                    'name' => 'Apartments',
                ],
            3 =>
                [
                    'id' => 5,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'clothes',
                    'name' => 'Clothes',
                ],
            4 =>
                [
                    'id' => 6,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'furniture',
                    'name' => 'Furniture',
                ],
            5 =>
                [
                    'id' => 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'appliances',
                    'name' => 'Appliances',
                ],
            6 =>
                [
                    'id' => 11,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'phones',
                    'name' => 'Phones',
                ],
            7 =>
                [
                    'id' => 12,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'tools',
                    'name' => 'Tools',
                ],
            8 =>
                [
                    'id' => 13,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'other',
                    'name' => 'Other',
                ],
            9 =>
                [
                    'id' => 15,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 1,
                    'slug' => 'roommates',
                    'name' => 'Roommates',
                ],
            10 =>
                [
                    'id' => 8,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'auto-parts',
                    'name' => 'Auto Parts',
                ],
            11 =>
                [
                    'id' => 14,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 2,
                    'slug' => 'houses-for-sale',
                    'name' => 'Houses For Sale',
                ],
            12 =>
                [
                    'id' => 4,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 1,
                    'slug' => 'houses-for-rent',
                    'name' => 'Houses For Rent',
                ],
            13 =>
                [
                    'id' => 9,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'computer-parts',
                    'name' => 'Computer Parts',
                ],
            14 =>
                [
                    'id' => 16,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'pet-services',
                    'name' => 'Pet Services',
                ],
            15 =>
                [
                    'id' => 17,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'moving-services',
                    'name' => 'Moving Services',
                ],
            16 =>
                [
                    'id' => 18,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'legal-services',
                    'name' => 'Legal Services',
                ],
            17 =>
                [
                    'id' => 19,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 2,
                    'slug' => 'condos-for-sale',
                    'name' => 'Condos For Sale',
                ],
            18 =>
                [
                    'id' => 20,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'automotive-services',
                    'name' => 'Automotive Services',
                ],
            19 =>
                [
                    'id' => 21,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'cleaning-services',
                    'name' => 'Cleaning Services',
                ],
            20 =>
                [
                    'id' => 22,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'beauty-services',
                    'name' => 'Beauty Services',
                ],
            21 =>
                [
                    'id' => 23,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'lessons-tutoring',
                    'name' => 'Lessons & Tutoring',
                ],
            22 =>
                [
                    'id' => 24,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'construction-services',
                    'name' => 'Construction Services',
                ],
            23 =>
                [
                    'id' => 25,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'home-services',
                    'name' => 'Home Services',
                ],
            24 =>
                [
                    'id' => 26,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 4,
                    'slug' => 'caregiving-baby-sitting',
                    'name' => 'Caregiving & Baby Sitting',
                ],
            25 =>
                [
                    'id' => 27,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'motorcycles',
                    'name' => 'Motorcycles',
                ],
            26 =>
                [
                    'id' => 28,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'bikes',
                    'name' => 'Bikes',
                ],
            27 =>
                [
                    'id' => 29,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 2,
                    'slug' => 'land-for-sale',
                    'name' => 'Land For Sale',
                ],
            28 =>
                [
                    'id' => 30,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 5,
                    'slug' => 'rvs',
                    'name' => 'RVs',
                ],
            29 =>
                [
                    'id' => 32,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'transportation-jobs',
                    'name' => 'Transportation Jobs',
                ],
            30 =>
                [
                    'id' => 33,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'legal-jobs',
                    'name' => 'Legal Jobs',
                ],
            31 =>
                [
                    'id' => 34,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'cleaning-jobs',
                    'name' => 'Cleaning Jobs',
                ],
            32 =>
                [
                    'id' => 35,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'accounting-jobs',
                    'name' => 'Accounting Jobs',
                ],
            33 =>
                [
                    'id' => 36,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'healthcare-jobs',
                    'name' => 'Healthcare Jobs',
                ],
            34 =>
                [
                    'id' => 38,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'tech-support-jobs',
                    'name' => 'Tech Support Jobs',
                ],
            35 =>
                [
                    'id' => 39,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'engineering-jobs',
                    'name' => 'Engineering Jobs',
                ],
            36 =>
                [
                    'id' => 40,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'educational-jobs',
                    'name' => 'Educational Jobs',
                ],
            37 =>
                [
                    'id' => 41,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'management-jobs',
                    'name' => 'Management Jobs',
                ],
            38 =>
                [
                    'id' => 42,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'financial-jobs',
                    'name' => 'Financial Jobs',
                ],
            39 =>
                [
                    'id' => 43,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'real-estate-jobs',
                    'name' => 'Real Estate Jobs',
                ],
            40 =>
                [
                    'id' => 44,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'sales-jobs',
                    'name' => 'Sales Jobs',
                ],
            41 =>
                [
                    'id' => 45,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'retail-jobs',
                    'name' => 'Retail Jobs',
                ],
            42 =>
                [
                    'id' => 46,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'creative-jobs',
                    'name' => 'Creative Jobs',
                ],
            43 =>
                [
                    'id' => 47,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'marketing-jobs',
                    'name' => 'Marketing Jobs',
                ],
            44 =>
                [
                    'id' => 48,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'security-jobs',
                    'name' => 'Security Jobs',
                ],
            45 =>
                [
                    'id' => 49,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'hospitality-jobs',
                    'name' => 'Hospitality Jobs',
                ],
            46 =>
                [
                    'id' => 31,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'software-jobs',
                    'name' => 'Software Jobs',
                ],
            47 =>
                [
                    'id' => 37,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'category_id' => 3,
                    'slug' => 'web-design-jobs',
                    'name' => 'Web Design Jobs',
                ],
        ]);


    }
}
