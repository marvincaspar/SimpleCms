<?php

use Laracasts\TestDummy\Factory;


class ExampleTest extends TestCase
{
    public function testBasicExample()
    {
        $contact = Factory::create('Mc388\SimpleCms\App\Models\Contact');

        dd($contact);
    }
}
