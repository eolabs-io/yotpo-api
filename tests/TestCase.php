<?php

namespace EolabsIo\YotpoApi\Tests;

use EolabsIo\YotpoApi\YotpoApiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('yotpo', [
            'client_id' => 'yotpoApi-client-id',
            'client_secret' => 'yotpoApi-client-secret',
            'app_key' => 'yotpoApi-app-key',
        ]);

        $default = 'testbench'; // 'mysql';

        $app['config']->set('database.default', $default);

        $app['config']->set('yotpo.database.connection', $default);

        $app['config']->set('database.connections.testbench', [
            'driver'   => env('DB_DRIVER', 'sqlite'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'prefix'   => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ]);

        $app['config']->set('database.connections.mysql', [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => 'LiftedNaturalsYotpoTest',
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
        ]);
    }

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [YotpoApiServiceProvider::class];
    }
    /**
     * Get package aliases.  In a normal app environment these would be added to
     * the 'aliases' array in the config/app.php file.  If your package exposes an
     * aliased facade, you should add the alias here, along with aliases for
     * facades upon which your package depends, e.g. Cartalyst/Sentry.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    // protected function getPackageAliases($app)
    // {
    //     return [
    //         // 'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
    //     ];
    // }
}
