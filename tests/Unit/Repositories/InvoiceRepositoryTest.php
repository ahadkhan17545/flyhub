<?php

use App\Models\Tenant\Invoice;
use App\Repositories\Tenant\InvoiceRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->invoiceRepo = new InvoiceRepository();
});

test('creates invoice', function () {
    $invoice = Invoice::factory()->make()->toArray();
    $createdInvoice = $this->invoiceRepo->create($invoice);
    $createdInvoice = $createdInvoice->toArray();
    $this->assertArrayHasKey('id', $createdInvoice);
    $this->assertNotNull($createdInvoice['id'], 'Created Invoice must have id specified');
    $this->assertNotNull(Invoice::find($createdInvoice['id']), 'Invoice with given id must be in DB');
    $this->assertModelData($invoice, $createdInvoice);
});

test('reads invoice', function () {
    $invoice = Invoice::factory()->create();
    $dbInvoice = $this->invoiceRepo->find($invoice->id);
    $dbInvoice = $dbInvoice->toArray();
    $this->assertModelData($invoice->toArray(), $dbInvoice);
});

test('updates invoice', function () {
    $invoice = Invoice::factory()->create();
    $fakeInvoice = Invoice::factory()->make()->toArray();
    $updatedInvoice = $this->invoiceRepo->update($fakeInvoice, $invoice->id);
    $this->assertModelData($fakeInvoice, $updatedInvoice->toArray());
    $dbInvoice = $this->invoiceRepo->find($invoice->id);
    $this->assertModelData($fakeInvoice, $dbInvoice->toArray());
});

test('deletes invoice', function () {
    $invoice = Invoice::factory()->create();
    $resp = $this->invoiceRepo->delete($invoice->id);
    $this->assertTrue($resp);
    $this->assertNull(Invoice::find($invoice->id), 'Invoice should not exist in DB');
});
