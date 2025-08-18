<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

/** @package Tests */
abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, ApiTestTrait;

    protected function setUp(): void
    {
        parent::setUp();

        // Ensure we're using the testing database connection
        $this->app['config']->set('database.default', 'testing');

        // Run migrations manually on the testing connection
        $this->runMigrations();
    }

    protected function runMigrations(): void
    {
        // Run main migrations
        Artisan::call('migrate', ['--database' => 'testing', '--force' => true]);

        // Run tenant migrations
        Artisan::call('migrate', [
            '--database' => 'testing',
            '--path' => 'database/migrations/tenant',
            '--force' => true
        ]);
    }

    protected function decodeJsonFile(string $path)
    {
        return json_decode(file_get_contents($path), true);
    }
}
