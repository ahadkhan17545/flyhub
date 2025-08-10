<?php

use App\Models\Tenant\State;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates country', function () {
    $country = State::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/countries', $country );
    $this->assertApiResponse($country);
});

test('reads country', function () {
    $country = State::factory()->create();
    $this->response = $this->json( 'GET', '/api/countries/' . $country->id );
    $this->assertApiResponse($country->toArray());
});

test('updates country', function () {
    $country = State::factory()->create();
    $editedCountry = State::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/countries/' . $country->id, $editedCountry );
    $this->assertApiResponse($editedCountry);
});

test('deletes country', function () {
    $country = State::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/countries/' . $country->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/countries/' . $country->id );
    $this->response->assertStatus(404);
});
