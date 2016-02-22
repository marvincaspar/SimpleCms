<?php

$factory(Mc388\SimpleCms\App\Models\Contact::class, [
    'name' => $faker->company,
    'street' => $faker->address,
    'postal_code' => $faker->postcode,
    'city' => $faker->city,
    'phone' => $faker->phoneNumber,
    'mobile' => $faker->phoneNumber,
    'fax' => $faker->phoneNumber,
    'email' => $faker->companyEmail
]);
