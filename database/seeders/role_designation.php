<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleDesignation;
class role_designation extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Marketing Manager',
            'Chief Marketing Officer (CMO)',
            'Business Developer',
            'Product Manager',
            'Growth Head',
            'Brand Strategist',
            'Founder / Owner'
        ];

        foreach ($roles as $role) {
            RoleDesignation::create(['title' => $role]);
        }
    }
}
