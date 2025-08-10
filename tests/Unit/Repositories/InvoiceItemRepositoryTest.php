<?php

use App\Models\Tenant\InvoiceItem;

uses(Tests\TestCase::class);

test('create invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->make()->toArray();
    $createdInvoiceItem = $this->invoiceItemRepo->create($invoiceItem);
    $createdInvoiceItem = $createdInvoiceItem->toArray();
    $this->assertArrayHasKey('id', $createdInvoiceItem);
    $this->assertNotNull($createdInvoiceItem['id'], 'Created InvoiceItem must have id specified');
    $this->assertNotNull(InvoiceItem::find($createdInvoiceItem['id']), 'InvoiceItem with given id must be in DB');
    $this->assertModelData($invoiceItem, $createdInvoiceItem);
});

test('read invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $dbInvoiceItem = $this->invoiceItemRepo->find($invoiceItem->id);
    $dbInvoiceItem = $dbInvoiceItem->toArray();
    $this->assertModelData($invoiceItem->toArray(), $dbInvoiceItem);
});

test('update invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $fakeInvoiceItem = InvoiceItem::factory()->make()->toArray();
    $updatedInvoiceItem = $this->invoiceItemRepo->update($fakeInvoiceItem, $invoiceItem->id);
    $this->assertModelData($fakeInvoiceItem, $updatedInvoiceItem->toArray());
    $dbInvoiceItem = $this->invoiceItemRepo->find($invoiceItem->id);
    $this->assertModelData($fakeInvoiceItem, $dbInvoiceItem->toArray());
});

test('delete invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $resp = $this->invoiceItemRepo->delete($invoiceItem->id);
    $this->assertTrue($resp);
    $this->assertNull(InvoiceItem::find($invoiceItem->id), 'InvoiceItem should not exist in DB');
});
