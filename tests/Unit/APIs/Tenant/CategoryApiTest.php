<?php

use App\Models\Tenant\Category;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('create_category', function () {
    $category = Category::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/categories', $category );
    $this->assertApiResponse($category);
});

test('read_category', function () {
    $category = Category::factory()->create();
    $this->response = $this->json( 'GET', '/api/categories/' . $category->id );
    $this->assertApiResponse($category->toArray());
});

test('update_category', function () {
    $category = Category::factory()->create();
    $editedCategory = Category::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/categories/' . $category->id, $editedCategory );
    $this->assertApiResponse($editedCategory);
});

test('delete_category', function () {
    $category = Category::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/categories/' . $category->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/categories/' . $category->id );
    $this->response->assertStatus(404);
});
