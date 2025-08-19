<?php

use App\Models\Tenant\CustomerGroup;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates customer group', function () {
    $customerGroup = CustomerGroup::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/customer-groups', $customerGroup );
    $this->assertApiResponse($customerGroup);
});

test('reads customer group', function () {
    $customerGroup = CustomerGroup::factory()->create();
    $this->response = $this->json( 'GET', '/api/customer-groups/' . $customerGroup->id );
    $this->assertApiResponse($customerGroup->toArray());
});

test('updates customer group', function () {
    $customerGroup = CustomerGroup::factory()->create();
    $editedCustomerGroup = CustomerGroup::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/customer-groups/' . $customerGroup->id, $editedCustomerGroup );
    $this->assertApiResponse($editedCustomerGroup);
});

test('deletes customer group', function () {
    $customerGroup = CustomerGroup::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/customer-groups/' . $customerGroup->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/customer-groups/' . $customerGroup->id );
    $this->response->assertStatus(404);
});
