<?php

use App\Models\Tenant\Refund;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates refund', function () {
    $refund = Refund::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/refunds', $refund );
    $this->assertApiResponse($refund);
});

test('reads refund', function () {
    $refund = Refund::factory()->create();
    $this->response = $this->json( 'GET', '/api/refunds/' . $refund->id );
    $this->assertApiResponse($refund->toArray());
});

test('updates refund', function () {
    $refund = Refund::factory()->create();
    $editedRefund = Refund::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/refunds/' . $refund->id, $editedRefund );
    $this->assertApiResponse($editedRefund);
});

test('deletes refund', function () {
    $refund = Refund::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/refunds/' . $refund->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/refunds/' . $refund->id );
    $this->response->assertStatus(404);
});
