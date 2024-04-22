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
                'no_of_products' => 1,
                'merchant_rating' => 0,
                'image_url' => 'unknown.jpg',
                'city' => 'Bacolod',
                'country' => 'Philippines',
                'state' => 'Negros Occ',
                'pickup_address' => 'San Juan St., Nangka Zone 1 Chapel, Bacolod City',
                'reg_address' => 'San Juan St., Nangka Zone 1 Chapel, Bacolod City',
                'postal_code' => '6100',
                'tin' => '456-123-789'
            ],

            [
                // John Doe
                'user_id' => 3,
                'store_name' => 'aquotool.ph',
                'no_of_products' => 1,
                'merchant_rating' => 0,
                'image_url' => 'unknown.jpg',
                'city' => 'Taguig',
                'country' => 'Philippines',
                'state' => 'Manila',
                'pickup_address' => 'GROUND FLOOR, SAN MARCO WING, VENICE GRAND CANAL MALL, McKinley Hill Dr, Taguig, 1637 Metro Manila',
                'reg_address' => 'Ascott Bonifacio Global City Manila, 5th Avenue 28th St, Taguig, 1634 Metro Manila',
                'postal_code' => '6100',
                'tin' => '321-789-456'
            ],
        ]);
    }
}
