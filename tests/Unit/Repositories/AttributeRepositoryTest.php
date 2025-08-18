<?php

use App\Models\Tenant\Attribute;
use App\Repositories\Tenant\AttributeRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->attributeRepo = new AttributeRepository();
});

test('create attribute', function () {
    $attribute = Attribute::factory()->make()->toArray();
    $createdAttribute = $this->attributeRepo->create($attribute);
    $createdAttribute = $createdAttribute->toArray();
    $this->assertArrayHasKey('id', $createdAttribute);
    $this->assertNotNull($createdAttribute['id'], 'Created Attribute must have id specified');
    $this->assertNotNull(Attribute::find($createdAttribute['id']), 'Attribute with given id must be in DB');
    $this->assertModelData($attribute, $createdAttribute);
});

test('read attribute', function () {
    $attribute = Attribute::factory()->create();
    $dbAttribute = $this->attributeRepo->find($attribute->id);
    $dbAttribute = $dbAttribute->toArray();
    $this->assertModelData($attribute->toArray(), $dbAttribute);
});

test('update attribute', function () {
    $attribute = Attribute::factory()->create();
    $fakeAttribute = Attribute::factory()->make()->toArray();
    $updatedAttribute = $this->attributeRepo->update($fakeAttribute, $attribute->id);
    $this->assertModelData($fakeAttribute, $updatedAttribute->toArray());
    $dbAttribute = $this->attributeRepo->find($attribute->id);
    $this->assertModelData($fakeAttribute, $dbAttribute->toArray());
});

test('delete attribute', function () {
    $attribute = Attribute::factory()->create();
    $resp = $this->attributeRepo->delete($attribute->id);
    $this->assertTrue($resp);
    $this->assertNull(Attribute::find($attribute->id), 'Attribute should not exist in DB');
});
