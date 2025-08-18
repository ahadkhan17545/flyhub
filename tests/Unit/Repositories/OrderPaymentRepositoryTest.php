<?php

use App\Models\Tenant\OrderPayment;
use App\Repositories\Tenant\OrderPaymentRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->orderPaymentRepo = new OrderPaymentRepository();
});

test('create order payment', function () {
    $orderPayment = OrderPayment::factory()->make()->toArray();
    $createdOrderPayment = $this->orderPaymentRepo->create($orderPayment);
    $createdOrderPayment = $createdOrderPayment->toArray();
    $this->assertArrayHasKey('id', $createdOrderPayment);
    $this->assertNotNull($createdOrderPayment['id'], 'Created OrderPayment must have id specified');
    $this->assertNotNull(OrderPayment::find($createdOrderPayment['id']), 'OrderPayment with given id must be in DB');
    $this->assertModelData($orderPayment, $createdOrderPayment);
});

test('read order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $dbOrderPayment = $this->orderPaymentRepo->find($orderPayment->id);
    $dbOrderPayment = $dbOrderPayment->toArray();
    $this->assertModelData($orderPayment->toArray(), $dbOrderPayment);
});

test('update order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $fakeOrderPayment = OrderPayment::factory()->make()->toArray();
    $updatedOrderPayment = $this->orderPaymentRepo->update($fakeOrderPayment, $orderPayment->id);
    $this->assertModelData($fakeOrderPayment, $updatedOrderPayment->toArray());
    $dbOrderPayment = $this->orderPaymentRepo->find($orderPayment->id);
    $this->assertModelData($fakeOrderPayment, $dbOrderPayment->toArray());
});

test('delete order payment', function () {
    $orderPayment = OrderPayment::factory()->create();
    $resp = $this->orderPaymentRepo->delete($orderPayment->id);
    $this->assertTrue($resp);
    $this->assertNull($this->orderPaymentRepo->find($orderPayment->id), 'OrderPayment should not exist in DB');
});
