<?php

use App\Models\Tenant\City;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates country state', function () {
    $countryState = City::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/country_states', $countryState );
    $this->assertApiResponse($countryState);
});

test('reads country state', function () {
    $countryState = City::factory()->create();
    $this->response = $this->json( 'GET', '/api/country_states/' . $countryState->id );
    $this->assertApiResponse($countryState->toArray());
});

test('updates country state', function () {
    $countryState = City::factory()->create();
    $editedCountryState = City::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/country_states/' . $countryState->id, $editedCountryState );
    $this->assertApiResponse($editedCountryState);
});

test('deletes country state', function () {
    $countryState = City::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/country_states/' . $countryState->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/country_states/' . $countryState->id );
    $this->response->assertStatus(404);
});
