<?php

use App\Models\Tenant\OrderPayment;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates order payment', function () {
    $orderPayment = OrderPayment::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/order-payments', $orderPayment );
    $this->assertApiResponse($orderPayment);
});

test('reads order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $this->response = $this->json( 'GET', '/api/order-payments/' . $orderPayment->id );
    $this->assertApiResponse($orderPayment->toArray());
});

test('updates order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $editedOrderPayment = OrderPayment::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/order-payments/' . $orderPayment->id, $editedOrderPayment );
    $this->assertApiResponse($editedOrderPayment);
});

test('deletes order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/order-payments/' . $orderPayment->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/order-payments/' . $orderPayment->id );
    $this->response->assertStatus(404);
});
