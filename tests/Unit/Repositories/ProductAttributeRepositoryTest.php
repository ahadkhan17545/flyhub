<?php

use App\Models\Tenant\ProductAttribute;

uses(Tests\TestCase::class);

test('create product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->make()->toArray();
    $createdProductAttribute = $this->productAttributeRepo->create($productAttribute);
    $createdProductAttribute = $createdProductAttribute->toArray();
    $this->assertArrayHasKey('id', $createdProductAttribute);
    $this->assertNotNull($createdProductAttribute['id'], 'Created ProductAttribute must have id specified');
    $this->assertNotNull(ProductAttribute::find($createdProductAttribute['id']), 'ProductAttribute with given id must be in DB');
    $this->assertModelData($productAttribute, $createdProductAttribute);
});

test('read product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create();
    $dbProductAttribute = $this->productAttributeRepo->find($productAttribute->id);
    $dbProductAttribute = $dbProductAttribute->toArray();
    $this->assertModelData($productAttribute->toArray(), $dbProductAttribute);
});

test('update product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create();
    $fakeProductAttribute = ProductAttribute::factory()->make()->toArray();
    $updatedProductAttribute = $this->productAttributeRepo->update($fakeProductAttribute, $productAttribute->id);
    $this->assertModelData($fakeProductAttribute, $updatedProductAttribute->toArray());
    $dbProductAttribute = $this->productAttributeRepo->find($productAttribute->id);
    $this->assertModelData($fakeProductAttribute, $dbProductAttribute->toArray());
});

test('delete product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create();
    $resp = $this->productAttributeRepo->delete($productAttribute->id);
    $this->assertTrue($resp);
    $this->assertNull(ProductAttribute::find($productAttribute->id), 'ProductAttribute should not exist in DB');
});
