<?php

use App\Models\Tenant\Product;

uses(Tests\TestCase::class);

test('create product', function () {
    $createdProduct = $this->productRepo->create($this->productInput);
    $createdProduct = $createdProduct->toArray();
    $this->assertArrayHasKey('id', $createdProduct);
    $this->assertNotNull($createdProduct['id'], 'Created Product must have id specified');
    $this->assertNotNull(Product::find($createdProduct['id']), 'Product with given id must be in DB');
});

test('read product', function () {
    $product = $this->productRepo->create($this->productInput[0]);
    $dbProduct = $this->productRepo->find($product->id);
    $dbProduct = $dbProduct->toArray();
    $this->assertModelData($product->toArray(), $dbProduct);
});

test('update product', function () {
    $product = $this->productRepo->create($this->productInput[0]);
    $updatedProduct = $this->productRepo->update([], $product->id);
    $this->assertModelData([], $updatedProduct->toArray());
    $dbProduct = $this->productRepo->find($product->id);
    $this->assertModelData([], $dbProduct->toArray());
});

test('delete product', function () {
    $product = $this->productRepo->create($this->productInput[0]);
    $resp = $this->productRepo->delete($product->id);
    $this->assertTrue($resp);
    $this->assertNull($this->productRepo->find($product->id), 'Product should not exist in DB');
});
