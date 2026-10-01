<?php

namespace App\Livewire;

use App\Models\ContactUs as ContactDetails;
use Livewire\Component;

class ContactUs extends Component
{
    public function render()
    {
        $contact = ContactDetails::query()->first();

        $departments = collect([
            [
                'title' => $contact?->customer_support_title ?: 'Customer support',
                'description' => $contact?->customer_support_description,
                'email' => $contact?->customer_support_email,
                'phone' => $contact?->customer_support_phone,
                'hours' => $contact?->customer_support_hours,
                'icon' => 'fa-headset',
            ],
            [
                'title' => $contact?->sales_partnerships_title ?: 'Sales and partnerships',
                'description' => $contact?->sales_partnerships_description,
                'email' => $contact?->sales_partnerships_email,
                'phone' => $contact?->sales_partnerships_phone,
                'hours' => $contact?->sales_partnerships_hours,
                'icon' => 'fa-handshake',
            ],
            [
                'title' => $contact?->education_training_title ?: 'Education and training',
                'description' => $contact?->education_training_description,
                'email' => $contact?->education_training_email,
                'phone' => $contact?->education_training_phone,
                'hours' => $contact?->education_training_hours,
                'icon' => 'fa-graduation-cap',
            ],
        ])->filter(fn (array $department): bool => collect($department)
            ->except(['title', 'icon'])
            ->contains(fn ($value): bool => filled($value)))
            ->values();

        $companyDetails = collect([
            'company' => ['label' => 'Company', 'value' => $contact?->company_name],
            'address' => ['label' => 'Address', 'value' => $contact?->address],
            'email' => ['label' => 'Email', 'value' => $contact?->email],
            'phone' => ['label' => 'Phone', 'value' => $contact?->phone],
            'website' => ['label' => 'Website', 'value' => $contact?->website],
        ])->filter(fn (array $detail): bool => filled($detail['value']));

        return view('livewire.contact-us', [
            'departments' => $departments,
            'companyDetails' => $companyDetails,
        ])->layout('layout.app', [
            'seoTitle' => 'Contact Genesis Block | Support & Partnerships',
            'seoDescription' => 'Contact Genesis Block for customer support, education, indicator access and partnership enquiries.',
            'seoCanonical' => route('contact-us'),
        ]);
    }
}
