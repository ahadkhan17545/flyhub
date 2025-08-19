<?php

use App\Models\Tenant\Tax;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates tax rate', function () {
    $taxRate = Tax::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/taxes', $taxRate );
    $this->assertApiResponse($taxRate);
});

test('reads tax rate', function () {
    $taxRate = Tax::factory()->create();
    $this->response = $this->json( 'GET', '/api/taxes/' . $taxRate->id );
    $this->assertApiResponse($taxRate->toArray());
});

test('updates tax rate', function () {
    $taxRate = Tax::factory()->create();
    $editedTaxRate = Tax::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/taxes/' . $taxRate->id, $editedTaxRate );
    $this->assertApiResponse($editedTaxRate);
});

test('deletes tax rate', function () {
    $taxRate = Tax::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/taxes/' . $taxRate->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/taxes/' . $taxRate->id );
    $this->response->assertStatus(404);
});
