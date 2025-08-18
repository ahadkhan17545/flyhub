<?php

use App\Models\Tenant\Customer;
use App\Models\Tenant\Channel;
use App\Repositories\Tenant\CustomerRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->customerRepo = new CustomerRepository();
    // Create a channel for foreign key constraints
    $this->channel = Channel::factory()->create();
});

test('create customer', function () {
    $customer = Customer::factory()->make(['channel_id' => $this->channel->id])->toArray();
    $createdCustomer = $this->customerRepo->create($customer);
    $createdCustomer = $createdCustomer->toArray();
    $this->assertArrayHasKey('id', $createdCustomer);
    $this->assertNotNull($createdCustomer['id'], 'Created Customer must have id specified');
    $this->assertNotNull(Customer::find($createdCustomer['id']), 'Customer with given id must be in DB');
    $this->assertModelData($customer, $createdCustomer);
});

test('read customer', function () {
    $customer = Customer::factory()->create(['channel_id' => $this->channel->id]);
    $dbCustomer = $this->customerRepo->find($customer->id);
    $dbCustomer = $dbCustomer->toArray();
    $this->assertModelData($customer->toArray(), $dbCustomer);
});

test('update customer', function () {
    $customer = Customer::factory()->create(['channel_id' => $this->channel->id]);
    $fakeCustomer = Customer::factory()->make(['channel_id' => $this->channel->id])->toArray();
    $updatedCustomer = $this->customerRepo->update($fakeCustomer, $customer->id);
    $this->assertModelData($fakeCustomer, $updatedCustomer->toArray());
    $dbCustomer = $this->customerRepo->find($customer->id);
    $this->assertModelData($fakeCustomer, $dbCustomer->toArray());
});

test('delete customer', function () {
    $customer = Customer::factory()->create(['channel_id' => $this->channel->id]);
    $resp = $this->customerRepo->delete($customer->id);
    $this->assertTrue($resp);
    $this->assertNull(Customer::find($customer->id), 'Customer should not exist in DB');
});
