<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
         DB::table('currencies')->insert([
            ['currency_code' => 'USD', 'currency_name' => 'US Dollar', 'exchange_rate' => 1.0000],
            ['currency_code' => 'INR', 'currency_name' => 'Indian Rupee', 'exchange_rate' => 74.50], // Example rate
            ['currency_code' => 'EUR', 'currency_name' => 'Euro', 'exchange_rate' => 0.85],
        ]);
    }
}
