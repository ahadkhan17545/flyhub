<?php

use App\Models\Tenant\ShipmentItem;
use App\Models\Tenant\Shipment;
use App\Models\Tenant\Order;
use App\Repositories\Tenant\ShipmentItemRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->shipmentItemRepo = new ShipmentItemRepository();
    // Create an order and a shipment for foreign key constraints
    $this->order = Order::factory()->create();
    $this->shipment = Shipment::factory()->create(['order_id' => $this->order->id]);
});

test('create shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->make(['shipment_id' => $this->shipment->id])->toArray();
    $createdShipmentItem = $this->shipmentItemRepo->create($shipmentItem);
    $createdShipmentItem = $createdShipmentItem->toArray();
    $this->assertArrayHasKey('id', $createdShipmentItem);
    $this->assertNotNull($createdShipmentItem['id'], 'Created ShipmentItem must have id specified');
    $this->assertNotNull(ShipmentItem::find($createdShipmentItem['id']), 'ShipmentItem must be in DB');
    $this->assertModelData($shipmentItem, $createdShipmentItem);
});

test('read shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create(['shipment_id' => $this->shipment->id]);
    $dbShipmentItem = $this->shipmentItemRepo->find($shipmentItem->id);
    $dbShipmentItem = $dbShipmentItem->toArray();
    $this->assertModelData($shipmentItem->toArray(), $dbShipmentItem);
});

test('update shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create(['shipment_id' => $this->shipment->id]);
    $fakeShipmentItem = ShipmentItem::factory()->make(['shipment_id' => $this->shipment->id])->toArray();
    $updatedShipmentItem = $this->shipmentItemRepo->update($fakeShipmentItem, $shipmentItem->id);
    $this->assertModelData($fakeShipmentItem, $updatedShipmentItem->toArray());
    $dbShipmentItem = $this->shipmentItemRepo->find($shipmentItem->id);
    $this->assertModelData($fakeShipmentItem, $dbShipmentItem->toArray());
});

test('delete shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create(['shipment_id' => $this->shipment->id]);
    $resp = $this->shipmentItemRepo->delete($shipmentItem->id);
    $this->assertTrue($resp);
    $this->assertNull($this->shipmentItemRepo->find($shipmentItem->id), 'ShipmentItem should not exist in DB');
});
