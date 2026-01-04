<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@admin.com',
            'phone_number' => '1234567890',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'),
        ]);

        $role = Role::create(['name' => 'admin']);
        $admin->assignRole($role);
    }
}
