<?php

use App\Models\Tenant\InvoiceItem;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/invoice-items', $invoiceItem );
    $this->assertApiResponse($invoiceItem);
});

test('reads invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $this->response = $this->json( 'GET', '/api/invoice-items/' . $invoiceItem->id );
    $this->assertApiResponse($invoiceItem->toArray());
});

test('updates invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $editedInvoiceItem = InvoiceItem::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/invoice-items/' . $invoiceItem->id, $editedInvoiceItem );
    $this->assertApiResponse($editedInvoiceItem);
});

test('deletes invoice item', function () {
    $invoiceItem = InvoiceItem::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/invoice-items/' . $invoiceItem->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/invoice-items/' . $invoiceItem->id );
    $this->response->assertStatus(404);
});
