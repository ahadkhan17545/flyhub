<?php

use App\Models\Tenant\InventorySource;
use App\Repositories\Tenant\InventorySourceRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->inventorySourceRepo = new InventorySourceRepository();
});

test('create inventory source', function () {
    $inventorySource = InventorySource::factory()->make()->toArray();
    $createdInventorySource = $this->inventorySourceRepo->create($inventorySource);
    $createdInventorySource = $createdInventorySource->toArray();
    $this->assertArrayHasKey('id', $createdInventorySource);
    $this->assertNotNull($createdInventorySource['id'], 'Created InventorySource must have id specified');
    $this->assertNotNull(InventorySource::find($createdInventorySource['id']), 'InventorySource with given id must be in DB');
    $this->assertModelData($inventorySource, $createdInventorySource);
});

test('read inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $dbInventorySource = $this->inventorySourceRepo->find($inventorySource->id);
    $dbInventorySource = $dbInventorySource->toArray();
    $this->assertModelData($inventorySource->toArray(), $dbInventorySource);
});

test('update inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $fakeInventorySource = InventorySource::factory()->make()->toArray();
    $updatedInventorySource = $this->inventorySourceRepo->update($fakeInventorySource, $inventorySource->id);
    $this->assertModelData($fakeInventorySource, $updatedInventorySource->toArray());
    $dbInventorySource = $this->inventorySourceRepo->find($inventorySource->id);
    $this->assertModelData($fakeInventorySource, $dbInventorySource->toArray());
});

test('delete inventory source', function () {
    $inventorySource = InventorySource::factory()->create();
    $resp = $this->inventorySourceRepo->delete($inventorySource->id);
    $this->assertTrue($resp);
    $this->assertNull(InventorySource::find($inventorySource->id), 'InventorySource should not exist in DB');
});
