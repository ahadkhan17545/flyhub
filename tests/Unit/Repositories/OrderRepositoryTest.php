<?php

use App\Models\Tenant\Order;

uses(Tests\TestCase::class);

test('create order', function () {
    $order = Order::factory()->make()->toArray();
    $createdOrder = $this->orderRepo->create($order);
    $createdOrder = $createdOrder->toArray();
    $this->assertArrayHasKey('id', $createdOrder);
    $this->assertNotNull($createdOrder['id'], 'Created Order must have id specified');
    $this->assertNotNull(Order::find($createdOrder['id']), 'Order with given id must be in DB');
    $this->assertModelData($order, $createdOrder);
});

test('read order', function () {
    $order = Order::factory()->create();
    $dbOrder = $this->orderRepo->find($order->id);
    $dbOrder = $dbOrder->toArray();
    $this->assertModelData($order->toArray(), $dbOrder);
});

test('update order', function () {
    $order = Order::factory()->create();
    $fakeOrder = Order::factory()->make()->toArray();
    $updatedOrder = $this->orderRepo->update($fakeOrder, $order->id);
    $this->assertModelData($fakeOrder, $updatedOrder->toArray());
    $dbOrder = $this->orderRepo->find($order->id);
    $this->assertModelData($fakeOrder, $dbOrder->toArray());
});

test('delete order', function () {
    $order = Order::factory()->create();
    $resp = $this->orderRepo->delete($order->id);
    $this->assertTrue($resp);
    $this->assertNull(Order::find($order->id), 'Order should not exist in DB');
});
