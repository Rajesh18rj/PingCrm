<?php

use App\Models\User;
use App\Models\Account;
use App\Models\Contact;
use Faker\Factory as Faker;




it('can store a contact', function() {

    $user = User::factory()->create([
        'account_id' => Account::create([
            'name' => 'Test Account',  // Adjust the name or fields as needed
        ])->id,  // Directly use the created Account's ID
    ]);

    // Log in as the user
    $this->actingAs($user);

    $faker = Faker::create();

    // Make the request to store the contact
    $this->post('/contacts', [
        'first_name' =>  $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' =>$faker->email(),
        'phone' =>$faker->e164PhoneNumber(),
        'address' => '1 Test Street',
        'city' => 'TesterField',
        'region' => 'DerbyShire',
        'country' =>$faker->randomElement(['us', 'ca']),
        'postal_code' =>$faker->postcode(),
    ])
    ->assertRedirect('/contacts')
    ->assertSessionHas('success', 'Contact created.');

    $contact = Contact::latest()->first();

    expect($contact)
        ->first_name->toBeString()->not->toBeEmpty()
        ->last_name->toBeString()->not->toBeEmpty()
        ->email->toBeString()->toContain('@')
        ->phone->toBePhoneNumber()
        ->city->toBe('TesterField')
        ->region->toBe('DerbyShire')
        ->country->toBeIn(['us', 'ca']);



});


