<?php

namespace Mc388\SimpleCms\Tests;

use Laracasts\TestDummy\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Orchestra\Testbench\TestCase;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Setup DB before each test.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->artisan('migrate', [
            '--database' => 'simple-cms',
            '--realpath' => realpath(__DIR__ . '/../src/database/migrations'),
        ]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'simple-cms');
        $app['config']->set('database.connections.simple-cms', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    public function testBasicExample()
    {
        $contact = Factory::create('Mc388\SimpleCms\App\Models\Contact');

        dd($contact);
    }
}
