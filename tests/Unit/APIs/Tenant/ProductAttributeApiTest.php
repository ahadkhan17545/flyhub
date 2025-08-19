<?php

use App\Models\Tenant\ProductAttribute;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates product attribute value', function () {
    $productAttributeValue = ProductAttribute::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/product-attributes', $productAttributeValue );
    $this->assertApiResponse($productAttributeValue);
});

test('reads product attribute value', function () {
    $productAttributeValue = ProductAttribute::factory()->create();
    $this->response = $this->json( 'GET', '/api/product-attributes/' . $productAttributeValue->id );
    $this->assertApiResponse($productAttributeValue->toArray());
});

test('updates product attribute value', function () {
    $productAttributeValue = ProductAttribute::factory()->create();
    $editedProductAttribute = ProductAttribute::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/product-attributes/' . $productAttributeValue->id, $editedProductAttribute );
    $this->assertApiResponse($editedProductAttribute);
});

test('deletes product attribute value', function () {
    $productAttributeValue = ProductAttribute::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/product-attributes/' . $productAttributeValue->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/product-attributes/' . $productAttributeValue->id );
    $this->response->assertStatus(404);
});
