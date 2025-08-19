<?php

use App\Models\Tenant\AttributeOption;
use App\Models\Tenant\Attribute;
use App\Repositories\Tenant\AttributeOptionRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->attributeOptionRepo = new AttributeOptionRepository();
    // Create an attribute for foreign key constraints
    $this->attribute = Attribute::factory()->create();
});

test('create attribute option', function () {
    $attributeOption = AttributeOption::factory()->make(['attribute_id' => $this->attribute->id])->toArray();
    $createdAttributeOption = $this->attributeOptionRepo->create($attributeOption);
    $createdAttributeOption = $createdAttributeOption->toArray();
    $this->assertArrayHasKey('id', $createdAttributeOption);
    $this->assertNotNull($createdAttributeOption['id'], 'Created AttributeOption must have id specified');
    $this->assertNotNull(AttributeOption::find($createdAttributeOption['id']), 'AttributeOption must be in DB');
    $this->assertModelData($attributeOption, $createdAttributeOption);
});

test('read attribute option', function () {
    $attributeOption = AttributeOption::factory()->create(['attribute_id' => $this->attribute->id]);
    $dbAttributeOption = $this->attributeOptionRepo->find($attributeOption->id);
    $dbAttributeOption = $dbAttributeOption->toArray();
    $this->assertModelData($attributeOption->toArray(), $dbAttributeOption);
});

test('update attribute option', function () {
    $attributeOption = AttributeOption::factory()->create(['attribute_id' => $this->attribute->id]);
    $fakeAttributeOption = AttributeOption::factory()->make(['attribute_id' => $this->attribute->id])->toArray();
    $updatedAttributeOption = $this->attributeOptionRepo->update($fakeAttributeOption, $attributeOption->id);
    $this->assertModelData($fakeAttributeOption, $updatedAttributeOption->toArray());
    $dbAttributeOption = $this->attributeOptionRepo->find($attributeOption->id);
    $this->assertModelData($fakeAttributeOption, $dbAttributeOption->toArray());
});

test('delete attribute option', function () {
    $attributeOption = AttributeOption::factory()->create(['attribute_id' => $this->attribute->id]);
    $resp = $this->attributeOptionRepo->delete($attributeOption->id);
    $this->assertTrue($resp);
    $this->assertNull(AttributeOption::find($attributeOption->id), 'AttributeOption should not exist in DB');
});
