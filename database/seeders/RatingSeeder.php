<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ratings')->insert([
            // Product 1
            [
                'user_id' => 3,
                'product_id' => 1,
                'rating' => 5,
                'review_text' => '2nd purchase ko na kay seller at ang ganda ng products! Hindi ka mapapahiya, ang sarap mgtanim kasi nkamulching na at wala kna iisipin pang damo! Recommended ang shop na ito, ang bilis pa dumating! 3days lng andto na! Salamat seller! Godbles',
                'created_at' => now()
            ],
            [
                'user_id' => 5,
                'product_id' => 1,
                'rating' => 5,
                'review_text' => 'The items are well packed kahit mabigat the courier still managed to deliver it. Walang damage yung package niya although bumaha sa hub. Kudos! To this store. More blessings to shower for all of us  💕',
                'created_at' => now()
            ],

            // Product 2
            [
                'user_id' => 2,
                'product_id' => 2,
                'rating' => 5,
                'review_text' => 'MaGanda ang kanilang product and its perfect for those who love gardening, sakto ang Pina dala walang labis walang kulang😊😊😊
                Happy buyer here... Until next time
                Continue your good services👍👍',
                'created_at' => now()
            ],
            [
                'user_id' => 4,
                'product_id' => 2,
                'rating' => 3,
                'review_text' => 'Hindi maayos pagka packed kahit naka bubble wrap pa dapat nilagay muna sa carton tsaka binalot sa bubble wrap hindi maka sustain ang bubble wrap yan sira sira na ang gilid.sana next time lagay muna sa box para secure ang parcel namin at para maging satisfied kami sa store nyo po',
                'created_at' => now()
            ],
            [
                'user_id' => 5,
                'product_id' => 2,
                'rating' => 4,
                'review_text' => 'Okay na okay. Un lng manipis, thank you seller',
                'created_at' => now()
            ],
        ]);
    }
}
