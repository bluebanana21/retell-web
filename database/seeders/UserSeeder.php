<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::createOrFirst([
            'name' => 'admin'
        ]);

        $guestRole = Role::createOrFirst([
            'name' => 'guest'
        ]);

        $receiptRole = Role::createOrFirst([
            'name' => 'receipt'
        ]);

        $admin = User::firstOrCreate([
            'email' => 'admin@retell.com',
            'name' => 'admin',
            'password' => 'passwword'

        ]);
        $admin->assignRole('admin');

        $guest = User::firstOrCreate([
            
        ]);
    }
}
