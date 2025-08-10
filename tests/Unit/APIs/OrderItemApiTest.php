<?php

use App\Models\Tenant\OrderItem;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates order item', function () {
    $orderItem = OrderItem::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/order-items', $orderItem );
    $this->assertApiResponse($orderItem);
});

test('reads order item', function () {
    $orderItem = OrderItem::factory()->create();
    $this->response = $this->json( 'GET', '/api/order-items/' . $orderItem->id );
    $this->assertApiResponse($orderItem->toArray());
});

test('update_order_item', function () {
    $orderItem = OrderItem::factory()->create();
    $editedOrderItem = OrderItem::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/order-items/' . $orderItem->id, $editedOrderItem );
    $this->assertApiResponse($editedOrderItem);
});

test('deletes order item', function () {
    $orderItem = OrderItem::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/order-items/' . $orderItem->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/order-items/' . $orderItem->id );
    $this->response->assertStatus(404);
});
