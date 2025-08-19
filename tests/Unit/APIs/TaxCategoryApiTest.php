<?php

use App\Models\Tenant\TaxGroup;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates tax category', function () {
    $taxCategory = TaxGroup::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/tax-groups', $taxCategory );
    $this->assertApiResponse($taxCategory);
});

test('reads tax category', function () {
    $taxCategory = TaxGroup::factory()->create();
    $this->response = $this->json( 'GET', '/api/tax-groups/' . $taxCategory->id );
    $this->assertApiResponse($taxCategory->toArray());
});

test('updates tax category', function () {
    $taxCategory = TaxGroup::factory()->create();
    $editedTaxCategory = TaxGroup::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/tax-groups/' . $taxCategory->id, $editedTaxCategory );
    $this->assertApiResponse($editedTaxCategory);
});

test('deletes tax category', function () {
    $taxCategory = TaxGroup::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/tax-groups/' . $taxCategory->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/tax-groups/' . $taxCategory->id );
    $this->response->assertStatus(404);
});
