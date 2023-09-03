<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\LaravelRay\RayServiceProvider;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected string $apiPath;

    protected function setUp(): void
    {
        parent::setUp();

        $this->apiPath = 'api';
        $this->seed();
    }

    protected function getPackageProviders($app): array
    {
        return [
            RayServiceProvider::class,
        ];
    }
}
