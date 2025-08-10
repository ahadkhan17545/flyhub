<?php

use App\Models\Tenant\ShipmentItem;

uses(Tests\TestCase::class);

test('create shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->make()->toArray();
    $createdShipmentItem = $this->shipmentItemRepo->create($shipmentItem);
    $createdShipmentItem = $createdShipmentItem->toArray();
    $this->assertArrayHasKey('id', $createdShipmentItem);
    $this->assertNotNull($createdShipmentItem['id'], 'Created ShipmentItem must have id specified');
    $this->assertNotNull(ShipmentItem::find($createdShipmentItem['id']), 'ShipmentItem with given id must be in DB');
    $this->assertModelData($shipmentItem, $createdShipmentItem);
});

test('read shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $dbShipmentItem = $this->shipmentItemRepo->find($shipmentItem->id);
    $dbShipmentItem = $dbShipmentItem->toArray();
    $this->assertModelData($shipmentItem->toArray(), $dbShipmentItem);
});

test('update shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $fakeShipmentItem = ShipmentItem::factory()->make()->toArray();
    $updatedShipmentItem = $this->shipmentItemRepo->update($fakeShipmentItem, $shipmentItem->id);
    $this->assertModelData($fakeShipmentItem, $updatedShipmentItem->toArray());
    $dbShipmentItem = $this->shipmentItemRepo->find($shipmentItem->id);
    $this->assertModelData($fakeShipmentItem, $dbShipmentItem->toArray());
});

test('delete shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $resp = $this->shipmentItemRepo->delete($shipmentItem->id);
    $this->assertTrue($resp);
    $this->assertNull(ShipmentItem::find($shipmentItem->id), 'ShipmentItem should not exist in DB');
});
