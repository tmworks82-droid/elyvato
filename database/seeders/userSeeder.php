<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use App\Models\User;

class userSeeder extends Seeder
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
                'phone' => '9956253635',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role' => 'admin', // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@citycab.com',
                'phone' => '9950253635',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role' => 'admin', // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Hr',
                'email' => 'hr@citycab.com',
                'phone' => '9450253635',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role' => 'admin', // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Telecaller (Verification)',
                'email' => 'verification@citycab.com',
                'phone' => '9450250635',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role' => 'admin', // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Telecaller',
                'email' => 'telecaller@citycab.com',
                'phone' => '9450200635',
                'password' => Hash::make('123456'), // Replace 'password' with the desired password
                'role' => 'admin', // ID of the 'superadmin' role from the roles table
            ]
            // Add more user data entries as needed
        ];

        foreach ($usersData as $userData) {
            $existingUser = User::where('email', $userData['email'])->first();

            if (!$existingUser) {
                USer::create($userData);
                $this->command->info("User '{$userData['name']}' inserted successfully.");
            } else {
                $this->command->info("User '{$userData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
