<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            RoleSeeder::class,
            LeadStatusSeeder::class,
            UnitSeeder::class,
            ServiceSeeder::class,
            ColorSeeder::class,
            RikshawModelSeeder::class,
            RikshawDifferentialCompanySeeder::class,
            ExpenseTypeSeeder::class,
            RikshawPowerModalSeeder::class,
            BatteryCompanySeeder::class,
            CargoSizeSeeder::class,
            RikshawDifferentialVariantSeeder::class,
            MoterControllerVariantSeeder::class,
            MoterControllerCompanySeeder::class,
            ChargerModalSeeder::class,
            BatteryAhSeeder::class,
            PermissionSeeder::class,
            PermissionRoleSeeder::class,
            VehicleTypeSeeder::class,
            
            
            // Add more seeders as needed
        ]);
    }
}
