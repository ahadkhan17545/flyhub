<?php

use App\Models\Tenant\Invoice;
use App\Models\Tenant\Order;
use App\Repositories\Tenant\InvoiceRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->invoiceRepo = new InvoiceRepository();
    // Create an order with required properties for invoice creation
    $this->order = Order::factory()->create([
        'status' => 'processing',
        'total_qty_ordered' => 5,
        'sub_total' => 100.00,
        'grand_total' => 120.00,
        'shipping_amount' => 10.00,
        'tax_amount' => 10.00,
        'discount_amount' => 0.00,
    ]);
});

test('creates invoice', function () {
    $invoice = Invoice::factory()->make(['order_id' => $this->order->id])->toArray();
    $createdInvoice = $this->invoiceRepo->create($invoice);
    $createdInvoice = $createdInvoice->toArray();
    $this->assertArrayHasKey('id', $createdInvoice);
    $this->assertNotNull($createdInvoice['id'], 'Created Invoice must have id specified');
    $this->assertNotNull(Invoice::find($createdInvoice['id']), 'Invoice with given id must be in DB');
    // Remove fields that the repository calculates from the order
    unset($invoice['state'], $invoice['total_qty'], $invoice['sub_total'], $invoice['grand_total'], $invoice['shipping_amount'], $invoice['tax_amount'], $invoice['discount_amount']);
    $this->assertModelData($invoice, $createdInvoice);
});

test('reads invoice', function () {
    $invoice = Invoice::factory()->create(['order_id' => $this->order->id]);
    $dbInvoice = $this->invoiceRepo->find($invoice->id);
    $dbInvoice = $dbInvoice->toArray();
    $this->assertModelData($invoice->toArray(), $dbInvoice);
});

test('updates invoice', function () {
    $invoice = Invoice::factory()->create(['order_id' => $this->order->id]);
    $fakeInvoice = Invoice::factory()->make(['order_id' => $this->order->id])->toArray();
    $updatedInvoice = $this->invoiceRepo->update($fakeInvoice, $invoice->id);
    $this->assertModelData($fakeInvoice, $updatedInvoice->toArray());
    $dbInvoice = $this->invoiceRepo->find($invoice->id);
    $this->assertModelData($fakeInvoice, $updatedInvoice->toArray());
});

test('deletes invoice', function () {
    $invoice = Invoice::factory()->create(['order_id' => $this->order->id]);
    $resp = $this->invoiceRepo->delete($invoice->id);
    $this->assertTrue($resp);
    $this->assertNull(Invoice::find($invoice->id), 'Invoice should not exist in DB');
});
