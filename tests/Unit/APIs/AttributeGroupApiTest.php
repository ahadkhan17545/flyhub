<?php

use App\Models\Tenant\AttributeGroup;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/attribute-groups', $attributeGroup );
    $this->assertApiResponse($attributeGroup);
});

test('reads attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $this->response = $this->json( 'GET', '/api/attribute-groups/' . $attributeGroup->id );
    $this->assertApiResponse($attributeGroup->toArray());
});

test('updates attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $editedAttributeGroup = AttributeGroup::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/attribute-groups/' . $attributeGroup->id, $editedAttributeGroup );
    $this->assertApiResponse($editedAttributeGroup);
});

test('deletes attribute group', function () {
    $attributeGroup = AttributeGroup::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/attribute-groups/' . $attributeGroup->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/attribute-groups/' . $attributeGroup->id );
    $this->response->assertStatus(404);
});
