<?php

use App\Models\Tenant\RefundItem;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates refund item', function () {
    $refundItem = RefundItem::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/refund-items', $refundItem );
    $this->assertApiResponse($refundItem);
});

test('reads refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $this->response = $this->json( 'GET', '/api/refund-items/' . $refundItem->id );
    $this->assertApiResponse($refundItem->toArray());
});

test('updates refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $editedRefundItem = RefundItem::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/refund-items/' . $refundItem->id, $editedRefundItem );
    $this->assertApiResponse($editedRefundItem);
});

test('deletes refund item', function () {
    $refundItem = RefundItem::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/refund-items/' . $refundItem->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/refund-items/' . $refundItem->id );
    $this->response->assertStatus(404);
});
