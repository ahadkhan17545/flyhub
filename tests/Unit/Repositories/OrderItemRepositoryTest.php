<?php

use App\Models\Tenant\OrderItem;
use App\Repositories\Tenant\OrderItemRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->orderItemRepo = new OrderItemRepository();
});

test('create order item', function () {
    $orderItem = OrderItem::factory()->make()->toArray();
    $createdOrderItem = $this->orderItemRepo->create($orderItem);
    $createdOrderItem = $createdOrderItem->toArray();
    $this->assertArrayHasKey('id', $createdOrderItem);
    $this->assertNotNull($createdOrderItem['id'], 'Created OrderItem must have id specified');
    $this->assertNotNull(OrderItem::find($createdOrderItem['id']), 'OrderItem with given id must be in DB');

    // Remove calculated fields from comparison since they're set by observer
    unset($orderItem['total']);
    $this->assertModelData($orderItem, $createdOrderItem);
});

test('read order item', function () {
    $orderItem = OrderItem::factory()->create();
    $dbOrderItem = $this->orderItemRepo->find($orderItem->id);
    $dbOrderItem = $dbOrderItem->toArray();
    $this->assertModelData($orderItem->toArray(), $dbOrderItem);
});

test('update order item', function () {
    $orderItem = OrderItem::factory()->create();
    $fakeOrderItem = OrderItem::factory()->make()->toArray();
    $updatedOrderItem = $this->orderItemRepo->update($fakeOrderItem, $orderItem->id);

    // Remove calculated fields from comparison since they're set by observer
    unset($fakeOrderItem['total']);
    $this->assertModelData($fakeOrderItem, $updatedOrderItem->toArray());

    $dbOrderItem = $this->orderItemRepo->find($orderItem->id);
    $this->assertModelData($fakeOrderItem, $dbOrderItem->toArray());
});

test('delete order item', function () {
    $orderItem = OrderItem::factory()->create();
    $resp = $this->orderItemRepo->delete($orderItem->id);
    $this->assertTrue($resp);
    $this->assertNull($this->orderItemRepo->find($orderItem->id), 'OrderItem should not exist in DB');
});
