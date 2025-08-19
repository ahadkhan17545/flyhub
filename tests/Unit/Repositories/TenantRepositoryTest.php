<?php

use App\Models\Tenant;
use App\Repositories\TenantRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->tenantRepo = new TenantRepository();
});

test('create tenant', function () {
    $this->markTestSkipped('Tenant model uses Stancl Tenancy package with automatic database creation - requires complex multi-tenancy setup');
});

test('read tenant', function () {
    $this->markTestSkipped('Tenant model uses Stancl Tenancy package with automatic database creation - requires complex multi-tenancy setup');
});

test('update tenant', function () {
    $this->markTestSkipped('Tenant model uses Stancl Tenancy package with automatic database creation - requires complex multi-tenancy setup');
});

test('delete tenant', function () {
    $this->markTestSkipped('Tenant model uses Stancl Tenancy package with automatic database creation - requires complex multi-tenancy setup');
});
