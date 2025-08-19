<?php

use App\Models\Tenant\ProductAttribute;
use App\Models\Tenant\Product;
use App\Models\Tenant\Attribute;
use App\Repositories\Tenant\ProductAttributeRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->productAttributeRepo = new ProductAttributeRepository();
    // Create required foreign key records
    $this->product = Product::factory()->create();
    $this->attribute = Attribute::factory()->create();
});

test('create product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->make([
        'product_id' => $this->product->id,
        'attribute_id' => $this->attribute->id
    ])->toArray();
    $createdProductAttribute = $this->productAttributeRepo->create($productAttribute);
    $createdProductAttribute = $createdProductAttribute->toArray();
    $this->assertArrayHasKey('id', $createdProductAttribute);
    $this->assertNotNull($createdProductAttribute['id'], 'Created ProductAttribute must have id specified');
    $this->assertNotNull(ProductAttribute::find($createdProductAttribute['id']), 'ProductAttribute with given id must be in DB');
    $this->assertModelData($productAttribute, $createdProductAttribute);
});

test('read product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create([
        'product_id' => $this->product->id,
        'attribute_id' => $this->attribute->id
    ]);
    $dbProductAttribute = $this->productAttributeRepo->find($productAttribute->id);
    $dbProductAttribute = $dbProductAttribute->toArray();
    $this->assertModelData($productAttribute->toArray(), $dbProductAttribute);
});

test('update product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create([
        'product_id' => $this->product->id,
        'attribute_id' => $this->attribute->id
    ]);
    $fakeProductAttribute = ProductAttribute::factory()->make([
        'product_id' => $this->product->id,
        'attribute_id' => $this->attribute->id
    ])->toArray();
    $updatedProductAttribute = $this->productAttributeRepo->update($fakeProductAttribute, $productAttribute->id);
    $this->assertModelData($fakeProductAttribute, $updatedProductAttribute->toArray());
    $dbProductAttribute = $this->productAttributeRepo->find($productAttribute->id);
    $this->assertModelData($fakeProductAttribute, $dbProductAttribute->toArray());
});

test('delete product attribute value', function () {
    $productAttribute = ProductAttribute::factory()->create([
        'product_id' => $this->product->id,
        'attribute_id' => $this->attribute->id
    ]);
    $resp = $this->productAttributeRepo->delete($productAttribute->id);
    $this->assertTrue($resp);
    $this->assertNull($this->productAttributeRepo->find($productAttribute->id), 'ProductAttribute should not exist in DB');
});
