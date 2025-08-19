<?php

use App\Models\Tenant\ShipmentItem;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/shipment-items', $shipmentItem );
    $this->assertApiResponse($shipmentItem);
});

test('reads shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $this->response = $this->json( 'GET', '/api/shipment-items/' . $shipmentItem->id );
    $this->assertApiResponse($shipmentItem->toArray());
});

test('updates shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $editedShipmentItem = ShipmentItem::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/shipment-items/' . $shipmentItem->id, $editedShipmentItem );
    $this->assertApiResponse($editedShipmentItem);
});

test('deletes shipment item', function () {
    $shipmentItem = ShipmentItem::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/shipment-items/' . $shipmentItem->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/shipment-items/' . $shipmentItem->id );
    $this->response->assertStatus(404);
});
