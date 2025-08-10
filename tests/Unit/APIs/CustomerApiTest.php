<?php

use App\Models\Tenant\Customer;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates customer', function () {
    $customer = Customer::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/customers', $customer );
    $this->assertApiResponse($customer);
});

test('reads customer', function () {
    $customer = Customer::factory()->create();
    $this->response = $this->json( 'GET', '/api/customers/' . $customer->id );
    $this->assertApiResponse($customer->toArray());
});

test('updates customer', function () {
    $customer = Customer::factory()->create();
    $editedCustomer = Customer::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/customers/' . $customer->id, $editedCustomer );
    $this->assertApiResponse($editedCustomer);
});

test('deletes customer', function () {
    $customer = Customer::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/customers/' . $customer->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/customers/' . $customer->id );
    $this->response->assertStatus(404);
});
