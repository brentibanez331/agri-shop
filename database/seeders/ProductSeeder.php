<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                // Brent Ibañez -- DEKES
                'merchant_id' => 1,
                // Farming Equipment
                'tag_id' => 1,
                'product_name' => 'Yoqu 3ft X 400m Agriculture Muching Film Vegetable Planting Film',
                'description' => '#aquosport☜ ☜follow shop Click here to buy an Excellent value for money and nice favorite product


                Specifications:
    
                size：1M*400

                Uses: Heat preservation and moisture retention, anti-tensile and wear-resisting, long service life, etc.
                
                Application:
                Overall ground protection, seedling bed base, material lap, laying cushion layer construction.
                Agriculture Black Film Vegetable Planting Plastic Mulching Film Plants Control Keep Warm Grow Film
                Mulch films retain moisture thus boost crop yields
                Prevent weeds growth
                Easy cleanup and maintenance
                Suppress weeds that make garden of farm neat and easy access
                Conserve water for much easier crop growth and production
                Intercept sunlight which help warming the soil result for faster growth of the plants or vegetables',
                
                'no_of_stocks' => 100,
                'product_rating' => 5.0,
                'product_image_url' => '1713745371.jpg',
                'items_sold' => 0,
                'price' => 180,
                'created_at' => now()
            ],

            [
                // John Doe -- aquotool.ph
                'merchant_id' => 2,
                // Farming Equipment
                'tag_id' => 1,
                'product_name' => 'Seedling Tray, Holes Gardening Germination Trays Starter Kit',
                'description' => 'High Quality Seedling Tray 128/105/72/50/32 Holes Seed Starter Kit Gardening Germination Trays Plant Nursery Pot , 10Pcs ONLY 185 Pesos , 20Pcs ONLY 365 Pesos.

                【About Buying】                                                                                                                                                                                         【COD】All the listed products are supported by cash on delivery;
                【Shipment】Your order will be shipped out within 24hrs from Manila;
                【Delivery】Takes around 2 days to arrive NCR and 2-5 days to other provinces;
                【Warranty】If these seed germination tray fail to meet your expectations, dont hesitate to contact us and benefit from our 100% customer satisfaction guarantee policy!',
                'no_of_stocks' => 50,
                'product_rating' => 4.0,
                'product_image_url' => 'sg-11134201-23010-yvi84mdzqulv87.jpg',
                'items_sold' => 0,
                'price' => 365,
                'created_at' => now() 
            ],
        ]);
    }
}
