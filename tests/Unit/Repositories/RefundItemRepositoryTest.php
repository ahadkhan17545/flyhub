<?php

use App\Models\Tenant\RefundItem;
use App\Repositories\Tenant\RefundItemRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->refundItemRepo = new RefundItemRepository();
});

test('create refund item', function () {
    $refundItem = RefundItem::factory()->make()->toArray();
    $createdRefundItem = $this->refundItemRepo->create($refundItem);
    $createdRefundItem = $createdRefundItem->toArray();
    $this->assertArrayHasKey('id', $createdRefundItem);
    $this->assertNotNull($createdRefundItem['id'], 'Created RefundItem must have id specified');
    $this->assertNotNull(RefundItem::find($createdRefundItem['id']), 'RefundItem with given id must be in DB');
    $this->assertModelData($refundItem, $createdRefundItem);
});

test('read refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $dbRefundItem = $this->refundItemRepo->find($refundItem->id);
    $dbRefundItem = $dbRefundItem->toArray();
    $this->assertModelData($refundItem->toArray(), $dbRefundItem);
});

test('update refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $fakeRefundItem = RefundItem::factory()->make()->toArray();
    $updatedRefundItem = $this->refundItemRepo->update($fakeRefundItem, $refundItem->id);
    $this->assertModelData($fakeRefundItem, $updatedRefundItem->toArray());
    $dbRefundItem = $this->refundItemRepo->find($refundItem->id);
    $this->assertModelData($fakeRefundItem, $dbRefundItem->toArray());
});

test('delete refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $resp = $this->refundItemRepo->delete($refundItem->id);
    $this->assertTrue($resp);
    $this->assertNull($this->refundItemRepo->find($refundItem->id), 'RefundItem should not exist in DB');
});
