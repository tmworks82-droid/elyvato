<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       


        $insertsData = [
            ['name' => 'Passenger', 'created_by'=>'1', 'name_slug'=>'passenger'],
            ['name' => 'Loader', 'created_by'=>'1', 'name_slug'=>'loader'],
            

            // Add more user data entries as needed
        ];


        

        foreach ($insertsData as $insertData) {
            $existingData = Service::where('name', $insertData['name'])->first();

            if (!$existingData) {
                Service::create($insertData);
                $this->command->info("Service '{$insertData['name']}' inserted successfully.");
            } else {
                $this->command->info("Service '{$insertData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
