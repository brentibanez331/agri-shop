<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MerchantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('merchants')->insert([
            [
                // Brent Ibañez
                'user_id' => 2,
                'store_name' => 'DEKES',
                'no_of_products' => 0,
                'merchant_rating' => 0,
                'image_url' => null,
                'city' => 'Bacolod',
            ],

            [
                // John Doe
                'user_id' => 3,
                'store_name' => 'aquotool.ph',
                'no_of_products' => 0,
                'merchant_rating' => 0,
                'image_url' => null,
                'city' => 'Taguig',
            ],
        ]);
    }
}
