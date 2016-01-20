<?php

namespace Mc388\SimpleCms\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Mc388\SimpleCms\App\Models\Contact;

/**
 * Class ContactSeeder
 */
class ContactSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->delete();

        Contact::create(
            [
                'name' => 'Company Name',
                'street' => 'Any Street',
                'postal_code' => '12345',
                'city' => 'Any City',
                'phone' => '0123456789',
                'mobile' => '0123456789',
                'fax' => '0123456789',
                'email' => 'any@email.com'
            ]
        );
    }
}
