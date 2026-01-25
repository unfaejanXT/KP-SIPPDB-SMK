<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\JurusanSeeder;
use Database\Seeders\PeriodePPDBSeeder;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Seed basic required data for the application to be "installed" and functional
        try {
            $this->seed([
                RoleSeeder::class,
                AdminSeeder::class,
                JurusanSeeder::class, // Might be needed for some views
                PeriodePPDBSeeder::class, // Might be needed for some views
            ]);
        } catch (\Exception $e) {
            // Seeding might fail if tables don't exist yet (unit tests) or other reasons
        }
    }
}
