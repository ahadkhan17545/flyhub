<?php

use App\Models\Tenant\Attribute;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\ApiTestTrait;

uses(Tests\TestCase::class, ApiTestTrait::class, WithoutMiddleware::class, DatabaseTransactions::class);

test('can create attribute', function () {
    $attribute = Attribute::factory()->make()->toArray();

    $this->response = $this->json(
        'POST',
        '/api/attributes',
        $attribute
    );

    $this->assertApiResponse($attribute);
});

test('can read attribute', function () {
    $attribute = Attribute::factory()->create();

    $this->response = $this->json(
        'GET',
        '/api/attributes/' . $attribute->id
    );

    $this->assertApiResponse($attribute->toArray());
});

test('can update attribute', function () {
    $attribute = Attribute::factory()->create();
    $editedAttribute = Attribute::factory()->make()->toArray();

    $this->response = $this->json(
        'PUT',
        '/api/attributes/' . $attribute->id,
        $editedAttribute
    );

    $this->assertApiResponse($editedAttribute);
});

test('can delete attribute', function () {
    $attribute = Attribute::factory()->create();

    $this->response = $this->json(
        'DELETE',
        '/api/attributes/' . $attribute->id
    );

    $this->assertApiSuccess();

    $this->response = $this->json(
        'GET',
        '/api/attributes/' . $attribute->id
    );

    $this->response->assertStatus(404);
});
