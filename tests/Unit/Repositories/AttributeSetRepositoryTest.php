<?php

use App\Models\Tenant\AttributeSet;

uses(Tests\TestCase::class);

test('create attribute set', function () {
    $attributeSet = AttributeSet::factory()->make()->toArray();
    $createdAttributeSet = $this->attributeSetRepo->create($attributeSet);
    $createdAttributeSet = $createdAttributeSet->toArray();
    $this->assertArrayHasKey('id', $createdAttributeSet);
    $this->assertNotNull($createdAttributeSet['id'], 'Created AttributeSet must have id specified');
    $this->assertNotNull(AttributeSet::find($createdAttributeSet['id']), 'AttributeSet with given id must be in DB');
    $this->assertModelData($attributeSet, $createdAttributeSet);
});

test('read attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $dbAttributeSet = $this->attributeSetRepo->find($attributeSet->id);
    $dbAttributeSet = $dbAttributeSet->toArray();
    $this->assertModelData($attributeSet->toArray(), $dbAttributeSet);
});

test('update attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $fakeAttributeSet = AttributeSet::factory()->make()->toArray();
    $updatedAttributeSet = $this->attributeSetRepo->update($fakeAttributeSet, $attributeSet->id);
    $this->assertModelData($fakeAttributeSet, $updatedAttributeSet->toArray());
    $dbAttributeSet = $this->attributeSetRepo->find($attributeSet->id);
    $this->assertModelData($fakeAttributeSet, $dbAttributeSet->toArray());
});

test('delete attribute set', function () {
    $attributeSet = AttributeSet::factory()->create();
    $resp = $this->attributeSetRepo->delete($attributeSet->id);
    $this->assertTrue($resp);
    $this->assertNull(AttributeSet::find($attributeSet->id), 'AttributeSet should not exist in DB');
});
