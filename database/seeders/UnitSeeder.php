<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertData = [
            [
                'name' => 'Kg'                
            ],
            [
                'name' => 'Gm'
            ],
            [
                'name' => 'Liter'
            ],
            [
                'name' => 'Dozon'
            ],
            [
                'name' => 'Piece'
            ],
        ];

        foreach ($insertData as $data) {
            $existingUser = Unit::where('name', $data['name'])->first();

            if (!$existingUser) {
                Unit::create($data);
                $this->command->info("Unit '{$data['name']}' inserted successfully.");
            } else {
                $this->command->info("Unit '{$data['name']}' already exists. Skipping insertion.");
            }
        }

        
    }
}
