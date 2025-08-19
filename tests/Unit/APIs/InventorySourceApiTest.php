<?php

use App\Models\Tenant\InventorySource;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates inventory source', function () {
    $inventorySource = InventorySource::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/inventory-sources', $inventorySource );
    $this->assertApiResponse($inventorySource);
});

test('reads inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $this->response = $this->json( 'GET', '/api/inventory-sources/' . $inventorySource->id );
    $this->assertApiResponse($inventorySource->toArray());
});

test('updates inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $editedInventorySource = InventorySource::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/inventory-sources/' . $inventorySource->id, $editedInventorySource );
    $this->assertApiResponse($editedInventorySource);
});

test('deletes inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/inventory-sources/' . $inventorySource->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/inventory-sources/' . $inventorySource->id );
    $this->response->assertStatus(404);
});
