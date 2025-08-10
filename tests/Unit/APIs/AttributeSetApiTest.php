<?php

use App\Models\Tenant\AttributeSet;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates attribute set', function () {
    $attributeSet = AttributeSet::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/attribute-sets', $attributeSet );
    $this->assertApiResponse($attributeSet);
});

test('reads attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $this->response = $this->json( 'GET', '/api/attribute-sets/' . $attributeSet->id );
    $this->assertApiResponse($attributeSet->toArray());
});

test('updates attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $editedAttributeSet = AttributeSet::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/attribute-sets/' . $attributeSet->id, $editedAttributeSet );
    $this->assertApiResponse($editedAttributeSet);
});

test('deletes attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/attribute-sets/' . $attributeSet->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/attribute-sets/' . $attributeSet->id );
    $this->response->assertStatus(404);
});
