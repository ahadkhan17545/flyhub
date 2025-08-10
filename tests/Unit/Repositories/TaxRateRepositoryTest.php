<?php

use App\Models\Tenant\Tax;

uses(Tests\TestCase::class);

test('create tax rate', function () {
    $taxRate = Tax::factory()->make()->toArray();
    $createdTaxRate = $this->taxRateRepo->create($taxRate);
    $createdTaxRate = $createdTaxRate->toArray();
    $this->assertArrayHasKey('id', $createdTaxRate);
    $this->assertNotNull($createdTaxRate['id'], 'Created TaxRate must have id specified');
    $this->assertNotNull(Tax::find($createdTaxRate['id']), 'TaxRate with given id must be in DB');
    $this->assertModelData($taxRate, $createdTaxRate);
});

test('read tax rate', function () {
    $taxRate = Tax::factory()->create();
    $dbTaxRate = $this->taxRateRepo->find($taxRate->id);
    $dbTaxRate = $dbTaxRate->toArray();
    $this->assertModelData($taxRate->toArray(), $dbTaxRate);
});

test('update tax rate', function () {
    $taxRate = Tax::factory()->create();
    $fakeTaxRate = Tax::factory()->make()->toArray();
    $updatedTaxRate = $this->taxRateRepo->update($fakeTaxRate, $taxRate->id);
    $this->assertModelData($fakeTaxRate, $updatedTaxRate->toArray());
    $dbTaxRate = $this->taxRateRepo->find($taxRate->id);
    $this->assertModelData($fakeTaxRate, $dbTaxRate->toArray());
});

test('delete tax rate', function () {
    $taxRate = Tax::factory()->create();
    $resp = $this->taxRateRepo->delete($taxRate->id);
    $this->assertTrue($resp);
    $this->assertNull(Tax::find($taxRate->id), 'TaxRate should not exist in DB');
});
