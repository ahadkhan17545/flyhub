<?php

use App\Models\Tenant\State;

uses(Tests\TestCase::class);

test('create country', function () {
    $country = State::factory()->make()->toArray();
    $createdCountry = $this->countryRepo->create($country);
    $createdCountry = $createdCountry->toArray();
    $this->assertArrayHasKey('id', $createdCountry);
    $this->assertNotNull($createdCountry['id'], 'Created Country must have id specified');
    $this->assertNotNull(State::find($createdCountry['id']), 'Country with given id must be in DB');
    $this->assertModelData($country, $createdCountry);
});

test('read country', function () {
    $country = State::factory()->create();
    $dbCountry = $this->countryRepo->find($country->id);
    $dbCountry = $dbCountry->toArray();
    $this->assertModelData($country->toArray(), $dbCountry);
});

test('update country', function () {
    $country = State::factory()->create();
    $fakeCountry = State::factory()->make()->toArray();
    $updatedCountry = $this->countryRepo->update($fakeCountry, $country->id);
    $this->assertModelData($fakeCountry, $updatedCountry->toArray());
    $dbCountry = $this->countryRepo->find($country->id);
    $this->assertModelData($fakeCountry, $dbCountry->toArray());
});

test('delete country', function () {
    $country = State::factory()->create();
    $resp = $this->countryRepo->delete($country->id);
    $this->assertTrue($resp);
    $this->assertNull(State::find($country->id), 'Country should not exist in DB');
});
