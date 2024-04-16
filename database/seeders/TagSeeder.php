<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['tag_name' => 'Farming Equipment'],
            ['tag_name' => 'Fresh Produce'],
            ['tag_name' => 'Livestock'],
            ['tag_name' => 'Plants and Seeds'],
        ]);
    }
}
