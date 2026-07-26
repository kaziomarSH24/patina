<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create basic roles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $dealerRole = Role::firstOrCreate(['name' => 'dealer', 'guard_name' => 'web']);
        $customerRole = Role::firstOrCreate(['name' => 'customer', 'guard_name' => 'web']);

        // Create a default admin user if one doesn't exist
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@patinawatches.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('password'),
                'phone_number' => '01700000000',
                'account_standing' => 'good',
                'email_verified_at' => now(),
            ]
        );

        // Assign the admin role to the user
        $adminUser->assignRole($adminRole);
    }
}
