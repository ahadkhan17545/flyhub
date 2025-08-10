<?php

use App\Models\Tenant\AttributeOption;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates attribute option', function () {
    $attributeOption = AttributeOption::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/attribute-options', $attributeOption );
    $this->assertApiResponse($attributeOption);
});

test('reads attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $this->response = $this->json( 'GET', '/api/attribute-options/' . $attributeOption->id );
    $this->assertApiResponse($attributeOption->toArray());
});

test('updates attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $editedAttributeOption = AttributeOption::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/attribute-options/' . $attributeOption->id, $editedAttributeOption );
    $this->assertApiResponse($editedAttributeOption);
});

test('deletes attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/attribute-options/' . $attributeOption->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/attribute-options/' . $attributeOption->id );
    $this->response->assertStatus(404);
});
