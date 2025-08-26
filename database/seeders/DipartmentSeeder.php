<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dipartment;

class DipartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Dipartment::insert([
            [
                'name' => 'Back Office',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Manufacturing',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CNM',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Painter',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Assembly',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PDI',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dispatcher',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
        ]);

    }
}
