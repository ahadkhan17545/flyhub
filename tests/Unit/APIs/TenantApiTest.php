<?php

use App\Models\Tenant;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates tenant', function () {
    $tenant = Tenant::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/tenants', $tenant );
    $this->assertApiResponse($tenant);
});

test('reads tenant', function () {
    $tenant = Tenant::factory()->create();
    $this->response = $this->json( 'GET', '/api/tenants/' . $tenant->id );
    $this->assertApiResponse($tenant->toArray());
});

test('updates tenant', function () {
    $tenant = Tenant::factory()->create();
    $editedTenant = Tenant::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/tenants/' . $tenant->id, $editedTenant );
    $this->assertApiResponse($editedTenant);
});

test('deletes tenant', function () {
    $tenant = Tenant::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/tenants/' . $tenant->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/tenants/' . $tenant->id );
    $this->response->assertStatus(404);
});
