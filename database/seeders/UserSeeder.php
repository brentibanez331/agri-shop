<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Administrator',
                'last_name' => '',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'is_admin' => 1,
                'password' => Hash::make('admin123'),
                'birthdate' => null,
                'address' => '',
                'phone_number' => null,
                'gender' => null
            ],

            [
                'first_name' => 'Brent',
                'last_name' => 'Ibañez',
                'username' => 'renibanez',
                'email' => 'brentibanez33@gmail.com',
                'is_admin' => 0,
                'password' => Hash::make('brent123'),
                'birthdate' => Carbon::parse('2002-08-31')->format('Y-m-d'),
                'address' => 'Brgy. 3, Bacolod City, PH',
                'phone_number' => '+639673144235',
                'gender' => 'Male'
            ],

            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'username' => 'johndoe123',
                'email' => 'johndoe@gmail.com',
                'is_admin' => 0,
                'password' => Hash::make('johndoe123'),
                'birthdate' => null,
                'address' => 'Woodside 1, Bacolod City, PH',
                'phone_number' => '+639062223560',
                'gender' => 'Male'
            ],

            [
                'first_name' => 'Jhanna',
                'last_name' => 'Villan',
                'username' => 'skzzz_jhanna',
                'email' => 'jhanna@gmail.com',
                'is_admin' => 0,
                'password' => Hash::make('jhanna123'),
                'birthdate' => Carbon::parse('2004-01-10')->format('Y-m-d'),
                'address' => 'Brgy. Cabug, Bacolod City, PH',
                'phone_number' => '+6390622456654',
                'gender' => 'Female'
            ],

            [
                'first_name' => 'Patrick',
                'last_name' => 'Flores',
                'username' => 're1423',
                'email' => 'patrick@gmail.com',
                'is_admin' => 0,
                'password' => Hash::make('patrick123'),
                'birthdate' => Carbon::parse('2002-09-11')->format('Y-m-d'),
                'address' => 'Woodside 1, Bacolod City, PH',
                'phone_number' => '+6393422478854',
                'gender' => 'Non-binary'
            ]
        ]);
    }
}
