<?php

use App\Livewire\Register as RegisterComponent;
use Livewire\Livewire;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('registration screen can be rendered', function () {
    $response = $this->get(route('register'));

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post(route('register.store'), [
        'name' => 'John Doe',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
});

test('registration success redirects to sign in with the new email prefilled', function () {
    Livewire::test(RegisterComponent::class)
        ->set('firstName', 'New')
        ->set('lastName', 'Member')
        ->set('email', 'new-user@example.test')
        ->set('phoneNumber', '')
        ->set('password', 'a-secure-password')
        ->set('password_confirmation', 'a-secure-password')
        ->call('register')
        ->assertRedirect(route('login', ['email' => 'new-user@example.test']));

    $response = $this->get(route('login', ['email' => 'new-user@example.test']));

    $response->assertOk()
        ->assertSee('value="new-user@example.test"', false);
});
