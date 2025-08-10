<?php

use App\Models\Tenant\Shipment;

uses(Tests\TestCase::class);

test('create shipment', function () {
    $shipment = Shipment::factory()->make()->toArray();
    $createdShipment = $this->shipmentRepo->create($shipment);
    $createdShipment = $createdShipment->toArray();
    $this->assertArrayHasKey('id', $createdShipment);
    $this->assertNotNull($createdShipment['id'], 'Created Shipment must have id specified');
    $this->assertNotNull(Shipment::find($createdShipment['id']), 'Shipment with given id must be in DB');
    $this->assertModelData($shipment, $createdShipment);
});

test('read shipment', function () {
    $shipment = Shipment::factory()->create();
    $dbShipment = $this->shipmentRepo->find($shipment->id);
    $dbShipment = $dbShipment->toArray();
    $this->assertModelData($shipment->toArray(), $dbShipment);
});

test('update shipment', function () {
    $shipment = Shipment::factory()->create();
    $fakeShipment = Shipment::factory()->make()->toArray();
    $updatedShipment = $this->shipmentRepo->update($fakeShipment, $shipment->id);
    $this->assertModelData($fakeShipment, $updatedShipment->toArray());
    $dbShipment = $this->shipmentRepo->find($shipment->id);
    $this->assertModelData($fakeShipment, $dbShipment->toArray());
});

test('delete shipment', function () {
    $shipment = Shipment::factory()->create();
    $resp = $this->shipmentRepo->delete($shipment->id);
    $this->assertTrue($resp);
    $this->assertNull(Shipment::find($shipment->id), 'Shipment should not exist in DB');
});
