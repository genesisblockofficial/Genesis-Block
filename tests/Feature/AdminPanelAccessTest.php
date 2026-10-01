<?php

use App\Models\User;
use Spatie\Permission\Models\Role;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('admin panel is only accessible to users with the admin role', function () {
    Role::create(['name' => 'customer']);
    $customer = User::factory()->create([
        'first_name' => 'Regular',
        'last_name' => 'Customer',
    ]);
    $customer->assignRole('customer');

    $this->actingAs($customer)
        ->get('/admin')
        ->assertForbidden();

    Role::create(['name' => 'admin']);
    $admin = User::factory()->create([
        'first_name' => 'Site',
        'last_name' => 'Admin',
    ]);
    $admin->assignRole('admin');

    $this->actingAs($admin)
        ->get('/admin')
        ->assertOk()
        ->assertSee('Genesis Block Admin');
});
