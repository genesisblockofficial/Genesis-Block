<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $firstName;

    public $lastName;

    public $email;

    public $phoneNumber;

    public $password;

    public $password_confirmation;

    protected $rules = [
        'firstName' => 'required|string|min:2',
        'lastName' => 'required|string|min:2',
        'email' => 'required|email|unique:users,email',
        'phoneNumber' => 'nullable|string|min:10',
        'password' => 'required|min:8|confirmed',
    ];

    protected $messages = [
        'firstName.required' => 'First name is required',
        'firstName.min' => 'First name must be at least 2 characters',
        'lastName.required' => 'Last name is required',
        'lastName.min' => 'Last name must be at least 2 characters',
        'email.required' => 'Email is required',
        'email.email' => 'Please enter a valid email address',
        'email.unique' => 'This email is already registered',
        'phoneNumber.min' => 'Phone number must be at least 10 digits',
        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 8 characters',
        'password.confirmed' => 'Passwords do not match',
    ];

    public function register()
    {
        $this->validate();

        try {
            $customer = User::create([
                'first_name' => $this->firstName,
                'last_name' => $this->lastName,
                'email' => $this->email,
                'phone_number' => $this->phoneNumber,
                'password' => Hash::make($this->password),
            ]);

            // Ensure customer role exists
            $role = Role::firstOrCreate(['name' => 'customer']);
            $customer->assignRole($role);

            $this->redirect(route('login', ['email' => $customer->email]));
        } catch (\Exception $e) {
            $this->dispatch(
                'registration-error',
                message: 'Registration failed. Please try again.'
            );
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.register')->layout('layout.app');
    }
}
