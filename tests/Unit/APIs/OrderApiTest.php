<?php

use App\Models\Tenant\Order;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates order', function () {
    $order = Order::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/orders', $order );
    $this->assertApiResponse($order);
});

test('reads order', function () {
    $order = Order::factory()->create();
    $this->response = $this->json( 'GET', '/api/orders/' . $order->id );
    $this->assertApiResponse($order->toArray());
});

test('updates order', function () {
    $order = Order::factory()->create();
    $editedOrder = Order::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/orders/' . $order->id, $editedOrder );
    $this->assertApiResponse($editedOrder);
});

test('deletes order', function () {
    $order = Order::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/orders/' . $order->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/orders/' . $order->id );
    $this->response->assertStatus(404);
});
