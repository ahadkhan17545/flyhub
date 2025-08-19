<?php

use App\Models\Tenant\Tax;
use App\Repositories\Tenant\TaxRateRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->taxRateRepo = new TaxRateRepository();
});

test('create tax rate', function () {
    $tax = Tax::factory()->make()->toArray();
    $tax['options'] = [];
    $createdTax = $this->taxRateRepo->create($tax);
    $createdTax = $createdTax->toArray();
    $this->assertArrayHasKey('id', $createdTax);
    $this->assertNotNull($createdTax['id'], 'Created Tax must have id specified');
    $this->assertNotNull(Tax::find($createdTax['id']), 'Tax with given id must be in DB');
    unset($tax['options']);
    $this->assertModelData($tax, $createdTax);
});

test('read tax rate', function () {
    $tax = Tax::factory()->create();
    $dbTax = $this->taxRateRepo->find($tax->id);
    $dbTax = $dbTax->toArray();
    $this->assertModelData($tax->toArray(), $dbTax);
});

test('update tax rate', function () {
    $tax = Tax::factory()->create();
    $fakeTax = Tax::factory()->make()->toArray();
    $fakeTax['options'] = [];
    $updatedTax = $this->taxRateRepo->update($fakeTax, $tax->id);
    $this->assertModelData($fakeTax, $updatedTax->toArray());
    $dbTax = $this->taxRateRepo->find($tax->id);
    $this->assertModelData($fakeTax, $dbTax->toArray());
});

test('delete tax rate', function () {
    $tax = Tax::factory()->create();
    $resp = $this->taxRateRepo->delete($tax->id);
    $this->assertTrue($resp);
    $this->assertNull($this->taxRateRepo->find($tax->id), 'Tax should not exist in DB');
});
