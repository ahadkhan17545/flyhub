<?php

use App\Models\Tenant\AttributeGroup;

uses(Tests\TestCase::class);

test('create attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->make()->toArray();
    $createdAttributeGroup = $this->attributeGroupRepo->create($attributeGroup);
    $createdAttributeGroup = $createdAttributeGroup->toArray();
    $this->assertArrayHasKey('id', $createdAttributeGroup);
    $this->assertNotNull($createdAttributeGroup['id'], 'Created AttributeGroup must have id specified');
    $this->assertNotNull(AttributeGroup::find($createdAttributeGroup['id']), 'AttributeGroup with given id must be in DB');
    $this->assertModelData($attributeGroup, $createdAttributeGroup);
});

test('read attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $dbAttributeGroup = $this->attributeGroupRepo->find($attributeGroup->id);
    $dbAttributeGroup = $dbAttributeGroup->toArray();
    $this->assertModelData($attributeGroup->toArray(), $dbAttributeGroup);
});

test('update attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $fakeAttributeGroup = AttributeGroup::factory()->make()->toArray();
    $updatedAttributeGroup = $this->attributeGroupRepo->update($fakeAttributeGroup, $attributeGroup->id);
    $this->assertModelData($fakeAttributeGroup, $updatedAttributeGroup->toArray());
    $dbAttributeGroup = $this->attributeGroupRepo->find($attributeGroup->id);
    $this->assertModelData($fakeAttributeGroup, $dbAttributeGroup->toArray());
});

test('delete attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $resp = $this->attributeGroupRepo->delete($attributeGroup->id);
    $this->assertTrue($resp);
    $this->assertNull(AttributeGroup::find($attributeGroup->id), 'AttributeGroup should not exist in DB');
});
