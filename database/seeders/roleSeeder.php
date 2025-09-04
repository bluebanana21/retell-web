<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create roles first (check if exists)
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $resepsionisRole = Role::firstOrCreate(['name' => 'resepsionis']);
        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Create permissions
        $permissions = [
            'manage hotels',
            'manage rooms',
            'manage bookings',
            'view reports',
            'manage users'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permissions to admin role
        $adminRole->givePermissionTo($permissions);

        // Create users and assign roles (check if exists)
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => 'password',
            ]
        );
        $adminUser->assignRole('admin');

        $resepsionisUser = User::firstOrCreate(
            ['email' => 'resepsionis@example.com'],
            [
                'name' => 'Resepsionis User',
                'password' => 'password',
            ]
        );
        $resepsionisUser->assignRole('resepsionis');

        $regularUser = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => 'password',
            ]
        );
        $regularUser->assignRole('user');
    }
}