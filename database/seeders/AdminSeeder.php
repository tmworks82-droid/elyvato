<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@citycab.com',
                'username' => 'superadmin123',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role_id' => 1, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@citycab.com',
                'username' => 'admin123',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role_id' => 2, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Hr',
                'email' => 'hr@citycab.com',
                'username' => 'hr123',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role_id' => 3, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Telecaller (Verification)',
                'email' => 'verification@citycab.com',
                'username' => 'telecaller_verification',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role_id' => 8, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Telecaller',
                'email' => 'telecaller@citycab.com',
                'username' => 'telecaller',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role_id' => 7, // ID of the 'superadmin' role from the roles table
            ]
            // Add more user data entries as needed
        ];

        foreach ($usersData as $userData) {
            $existingUser = Admin::where('email', $userData['email'])->first();

            if (!$existingUser) {
                Admin::create($userData);
                $this->command->info("User '{$userData['name']}' inserted successfully.");
            } else {
                $this->command->info("User '{$userData['name']}' already exists. Skipping insertion.");
            }
        }

        
    }
}
