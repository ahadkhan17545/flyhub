<?php

use App\Models\Tenant\OrderItem;

uses(Tests\TestCase::class);

test('creates order item', function () {
    $orderItem = OrderItem::factory()->make()->toArray();
    $createdOrderItem = $this->orderItemRepo->create($orderItem);
    $createdOrderItem = $createdOrderItem->toArray();
    $this->assertArrayHasKey('id', $createdOrderItem);
    $this->assertNotNull($createdOrderItem['id'], 'Created OrderItem must have id specified');
    $this->assertNotNull(OrderItem::find($createdOrderItem['id']), 'OrderItem with given id must be in DB');
    $this->assertModelData($orderItem, $createdOrderItem);
});

test('reads order item', function () {
    $orderItem = OrderItem::factory()->create();
    $dbOrderItem = $this->orderItemRepo->find($orderItem->id);
    $dbOrderItem = $dbOrderItem->toArray();
    $this->assertModelData($orderItem->toArray(), $dbOrderItem);
});

test('updates order item', function () {
    $orderItem = OrderItem::factory()->create();
    $fakeOrderItem = OrderItem::factory()->make()->toArray();
    $updatedOrderItem = $this->orderItemRepo->update($fakeOrderItem, $orderItem->id);
    $this->assertModelData($fakeOrderItem, $updatedOrderItem->toArray());
    $dbOrderItem = $this->orderItemRepo->find($orderItem->id);
    $this->assertModelData($fakeOrderItem, $dbOrderItem->toArray());
});

test('deletes order item', function () {
    $orderItem = OrderItem::factory()->create();
    $resp = $this->orderItemRepo->delete($orderItem->id);
    $this->assertTrue($resp);
    $this->assertNull(OrderItem::find($orderItem->id), 'OrderItem should not exist in DB');
});
