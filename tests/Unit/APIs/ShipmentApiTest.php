<?php

use App\Models\Tenant\Shipment;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates shipment', function () {
    $shipment = Shipment::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/shipments', $shipment );
    $this->assertApiResponse($shipment);
});

test('reads shipment', function () {
    $shipment = Shipment::factory()->create();
    $this->response = $this->json( 'GET', '/api/shipments/' . $shipment->id );
    $this->assertApiResponse($shipment->toArray());
});

test('updates shipment', function () {
    $shipment = Shipment::factory()->create();
    $editedShipment = Shipment::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/shipments/' . $shipment->id, $editedShipment );
    $this->assertApiResponse($editedShipment);
});

test('deletes shipment', function () {
    $shipment = Shipment::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/shipments/' . $shipment->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/shipments/' . $shipment->id );
    $this->response->assertStatus(404);
});
