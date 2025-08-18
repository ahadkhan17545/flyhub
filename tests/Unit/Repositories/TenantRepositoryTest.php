<?php

use App\Models\Tenant;
use App\Repositories\TenantRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->tenantRepo = new TenantRepository();
});

test('create tenant', function () {
    $tenant = Tenant::factory()->make()->toArray();
    $createdTenant = $this->tenantRepo->create($tenant);
    $createdTenant = $createdTenant->toArray();
    $this->assertArrayHasKey('id', $createdTenant);
    $this->assertNotNull($createdTenant['id'], 'Created Tenant must have id specified');
    $this->assertNotNull(Tenant::find($createdTenant['id']), 'Tenant with given id must be in DB');
    $this->assertModelData($tenant, $createdTenant);
});

test('read tenant', function () {
    $tenant = Tenant::factory()->create();
    $dbTenant = $this->tenantRepo->find($tenant->id);
    $dbTenant = $dbTenant->toArray();
    $this->assertModelData($tenant->toArray(), $dbTenant);
});

test('update tenant', function () {
    $tenant = Tenant::factory()->create();
    $fakeTenant = Tenant::factory()->make()->toArray();
    $updatedTenant = $this->tenantRepo->update($fakeTenant, $tenant->id);
    $this->assertModelData($fakeTenant, $updatedTenant->toArray());
    $dbTenant = $this->tenantRepo->find($tenant->id);
    $this->assertModelData($fakeTenant, $dbTenant->toArray());
});

test('delete tenant', function () {
    $tenant = Tenant::factory()->create();
    $resp = $this->tenantRepo->delete($tenant->id);
    $this->assertTrue($resp);
    $this->assertNull($this->tenantRepo->find($tenant->id), 'Tenant should not exist in DB');
});
