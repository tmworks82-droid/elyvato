<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class departmentseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        Department::insert([
            
            [
                'name' => 'Technical Support',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Billing & Payments',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Operation Support',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [ 
                'name' => 'Other',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
