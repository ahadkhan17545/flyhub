<?php

use App\Models\Tenant\Invoice;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates invoice', function () {
    $invoice = Invoice::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/invoices', $invoice );
    $this->assertApiResponse($invoice);
});

test('reads invoice', function () {
    $invoice = Invoice::factory()->create();
    $this->response = $this->json( 'GET', '/api/invoices/' . $invoice->id );
    $this->assertApiResponse($invoice->toArray());
});

test('updates invoice', function () {
    $invoice = Invoice::factory()->create();
    $editedInvoice = Invoice::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/invoices/' . $invoice->id, $editedInvoice );
    $this->assertApiResponse($editedInvoice);
});

test('deletes invoice', function () {
    $invoice = Invoice::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/invoices/' . $invoice->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/invoices/' . $invoice->id );
    $this->response->assertStatus(404);
});
