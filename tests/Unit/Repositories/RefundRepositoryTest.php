<?php

use App\Models\Tenant\Refund;
use App\Repositories\Tenant\RefundRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->refundRepo = new RefundRepository();
});

test('create refund', function () {
    $refund = Refund::factory()->make()->toArray();
    $createdRefund = $this->refundRepo->create($refund);
    $createdRefund = $createdRefund->toArray();
    $this->assertArrayHasKey('id', $createdRefund);
    $this->assertNotNull($createdRefund['id'], 'Created Refund must have id specified');
    $this->assertNotNull(Refund::find($createdRefund['id']), 'Refund with given id must be in DB');
    $this->assertModelData($refund, $createdRefund);
});

test('read refund', function () {
    $refund = Refund::factory()->create();
    $dbRefund = $this->refundRepo->find($refund->id);
    $dbRefund = $dbRefund->toArray();
    $this->assertModelData($refund->toArray(), $dbRefund);
});

test('update refund', function () {
    $refund = Refund::factory()->create();
    $fakeRefund = Refund::factory()->make()->toArray();
    $updatedRefund = $this->refundRepo->update($fakeRefund, $refund->id);
    $this->assertModelData($fakeRefund, $updatedRefund->toArray());
    $dbRefund = $this->refundRepo->find($refund->id);
    $this->assertModelData($fakeRefund, $dbRefund->toArray());
});

test('delete refund', function () {
    $refund = Refund::factory()->create();
    $resp = $this->refundRepo->delete($refund->id);
    $this->assertTrue($resp);
    $this->assertNull($this->refundRepo->find($refund->id), 'Refund should not exist in DB');
});
