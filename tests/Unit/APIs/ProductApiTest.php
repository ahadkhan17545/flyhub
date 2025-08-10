<?php

use App\Models\Tenant\Product;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates product', function () {
    $product = Product::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/products', $product );
    $this->assertApiResponse($product);
});

test('reads product', function () {
    $product = Product::factory()->create();
    $this->response = $this->json( 'GET', '/api/products/' . $product->id );
    $this->assertApiResponse($product->toArray());
});

test('updates product', function () {
    $product = Product::factory()->create();
    $editedProduct = Product::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/products/' . $product->id, $editedProduct );
    $this->assertApiResponse($editedProduct);
});

test('deletes product', function () {
    $product = Product::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/products/' . $product->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/products/' . $product->id );
    $this->response->assertStatus(404);
});
