<?php

use App\Models\Tenant\Product;
use App\Repositories\Tenant\ProductRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->productRepo = new ProductRepository();
});

test('create product', function () {
    $product = Product::factory()->make()->toArray();
    $createdProduct = $this->productRepo->create($product);
    $createdProduct = $createdProduct->toArray();
    $this->assertArrayHasKey('id', $createdProduct);
    $this->assertNotNull($createdProduct['id'], 'Created Product must have id specified');
    $this->assertNotNull(Product::find($createdProduct['id']), 'Product with given id must be in DB');
    $this->assertModelData($product, $createdProduct);
});

test('read product', function () {
    $product = Product::factory()->create();
    $dbProduct = $this->productRepo->find($product->id);
    $dbProduct = $dbProduct->toArray();
    $this->assertModelData($product->toArray(), $dbProduct);
});

test('update product', function () {
    $product = Product::factory()->create();
    $fakeProduct = Product::factory()->make()->toArray();
    $updatedProduct = $this->productRepo->update($fakeProduct, $product->id);
    $this->assertModelData($fakeProduct, $updatedProduct->toArray());
    $dbProduct = $this->productRepo->find($product->id);
    $this->assertModelData($fakeProduct, $dbProduct->toArray());
});

test('delete product', function () {
    $product = Product::factory()->create();
    $resp = $this->productRepo->delete($product->id);
    $this->assertTrue($resp);
    $this->assertNull($this->productRepo->find($product->id), 'Product should not exist in DB');
});
