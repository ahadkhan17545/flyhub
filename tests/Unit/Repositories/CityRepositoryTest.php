<?php

use App\Models\Tenant\City;

uses(Tests\TestCase::class);

test('create country state', function () {
    $countryState = City::factory()->make()->toArray();
    $createdCountryState = $this->countryStateRepo->create($countryState);
    $createdCountryState = $createdCountryState->toArray();
    $this->assertArrayHasKey('id', $createdCountryState);
    $this->assertNotNull($createdCountryState['id'], 'Created CountryState must have id specified');
    $this->assertNotNull(City::find($createdCountryState['id']), 'CountryState with given id must be in DB');
    $this->assertModelData($countryState, $createdCountryState);
});

test('read country state', function () {
    $countryState = City::factory()->create();
    $dbCountryState = $this->countryStateRepo->find($countryState->id);
    $dbCountryState = $dbCountryState->toArray();
    $this->assertModelData($countryState->toArray(), $dbCountryState);
});

test('update country state', function () {
    $countryState = City::factory()->create();
    $fakeCountryState = City::factory()->make()->toArray();
    $updatedCountryState = $this->countryStateRepo->update($fakeCountryState, $countryState->id);
    $this->assertModelData($fakeCountryState, $updatedCountryState->toArray());
    $dbCountryState = $this->countryStateRepo->find($countryState->id);
    $this->assertModelData($fakeCountryState, $dbCountryState->toArray());
});

test('delete country state', function () {
    $countryState = City::factory()->create();
    $resp = $this->countryStateRepo->delete($countryState->id);
    $this->assertTrue($resp);
    $this->assertNull(City::find($countryState->id), 'CountryState should not exist in DB');
});
