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

        // Only run migrations if they haven't been run yet
        if (!$this->migrationsHaveRun()) {
            $this->runMigrations();
        }
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

    protected function migrationsHaveRun(): bool
    {
        try {
            // Check if the migrations table exists and has records
            return \Schema::hasTable('migrations') && \DB::table('migrations')->count() > 0;
        } catch (\Exception $e) {
            return false;
        }
    }
}
