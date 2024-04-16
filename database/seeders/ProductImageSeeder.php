<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImageSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_images')->insert([
            [
                'product_id' => 1,
                'image_path' => 'cn-11134207-7r98o-locdixsbc2brcd.jpg'
            ],
            [
                'product_id' => 2,
                'image_path' => 'sg-11134201-23010-yvi84mdzqulv87.jpg'
            ],
        ]);
    }
}
