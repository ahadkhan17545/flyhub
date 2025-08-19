<?php

use App\Models\Tenant\Shipment;
use App\Models\Tenant\Order;
use App\Repositories\Tenant\ShipmentRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->shipmentRepo = new ShipmentRepository();
    $this->order = Order::factory()->create();
});

test('create shipment', function () {
    $shipment = Shipment::factory()->make(['order_id' => $this->order->id])->toArray();
    $createdShipment = $this->shipmentRepo->create($shipment);
    $createdShipment = $createdShipment->toArray();
    $this->assertArrayHasKey('id', $createdShipment);
    $this->assertNotNull($createdShipment['id'], 'Created Shipment must have id specified');
    $this->assertNotNull(Shipment::find($createdShipment['id']), 'Shipment with given id must be in DB');
    $this->assertModelData($shipment, $createdShipment);
});

test('read shipment', function () {
    $shipment = Shipment::factory()->create(['order_id' => $this->order->id]);
    $dbShipment = $this->shipmentRepo->find($shipment->id);
    $dbShipment = $dbShipment->toArray();
    $this->assertModelData($shipment->toArray(), $dbShipment);
});

test('update shipment', function () {
    $shipment = Shipment::factory()->create(['order_id' => $this->order->id]);
    $fakeShipment = Shipment::factory()->make(['order_id' => $this->order->id])->toArray();
    $updatedShipment = $this->shipmentRepo->update($fakeShipment, $shipment->id);
    $this->assertModelData($fakeShipment, $updatedShipment->toArray());
    $dbShipment = $this->shipmentRepo->find($shipment->id);
    $this->assertModelData($fakeShipment, $dbShipment->toArray());
});

test('delete shipment', function () {
    $shipment = Shipment::factory()->create(['order_id' => $this->order->id]);
    $resp = $this->shipmentRepo->delete($shipment->id);
    $this->assertTrue($resp);
    $this->assertNull($this->shipmentRepo->find($shipment->id), 'Shipment should not exist in DB');
});
