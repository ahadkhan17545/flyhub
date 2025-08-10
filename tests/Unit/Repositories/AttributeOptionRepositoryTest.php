<?php

use App\Models\Tenant\AttributeOption;

uses(Tests\TestCase::class);

test('create attribute option', function () {
    $attributeOption = AttributeOption::factory()->make()->toArray();
    $createdAttributeOption = $this->attributeOptionRepo->create($attributeOption);
    $createdAttributeOption = $createdAttributeOption->toArray();
    $this->assertArrayHasKey('id', $createdAttributeOption);
    $this->assertNotNull($createdAttributeOption['id'], 'Created AttributeOption must have id specified');
    $this->assertNotNull(AttributeOption::find($createdAttributeOption['id']), 'AttributeOption with given id must be in DB');
    $this->assertModelData($attributeOption, $createdAttributeOption);
});

test('read attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $dbAttributeOption = $this->attributeOptionRepo->find($attributeOption->id);
    $dbAttributeOption = $dbAttributeOption->toArray();
    $this->assertModelData($attributeOption->toArray(), $dbAttributeOption);
});

test('update attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $fakeAttributeOption = AttributeOption::factory()->make()->toArray();
    $updatedAttributeOption = $this->attributeOptionRepo->update($fakeAttributeOption, $attributeOption->id);
    $this->assertModelData($fakeAttributeOption, $updatedAttributeOption->toArray());
    $dbAttributeOption = $this->attributeOptionRepo->find($attributeOption->id);
    $this->assertModelData($fakeAttributeOption, $dbAttributeOption->toArray());
});

test('delete attribute option', function () {
    $attributeOption = AttributeOption::factory()->create();
    $resp = $this->attributeOptionRepo->delete($attributeOption->id);
    $this->assertTrue($resp);
    $this->assertNull(AttributeOption::find($attributeOption->id), 'AttributeOption should not exist in DB');
});
