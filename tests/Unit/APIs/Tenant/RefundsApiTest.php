<?php

use App\Models\Tenant\Refunds;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates refunds', function () {
    $refunds = Refunds::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/refunds', $refunds );
    $this->assertApiResponse($refunds);
});

test('reads refunds', function () {
    $refunds = Refunds::factory()->create();
    $this->response = $this->json( 'GET', '/api/refunds/' . $refunds->id );
    $this->assertApiResponse($refunds->toArray());
});

test('updates refunds', function () {
    $refunds = Refunds::factory()->create();
    $editedRefunds = Refunds::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/refunds/' . $refunds->id, $editedRefunds );
    $this->assertApiResponse($editedRefunds);
});

test('deletes refunds', function () {
    $refunds = Refunds::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/refunds/' . $refunds->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/refunds/' . $refunds->id );
    $this->response->assertStatus(404);
});
