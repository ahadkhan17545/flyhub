<?php

use App\Models\Tenant\City;
use App\Repositories\Tenant\CityRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->cityRepo = new CityRepository();
});

test('create city', function () {
    $city = City::factory()->make()->toArray();
    $createdCity = $this->cityRepo->create($city);
    $createdCity = $createdCity->toArray();
    $this->assertArrayHasKey('id', $createdCity);
    $this->assertNotNull($createdCity['id'], 'Created City must have id specified');
    $this->assertNotNull(City::find($createdCity['id']), 'City with given id must be in DB');
    $this->assertModelData($city, $createdCity);
});

test('read city', function () {
    $city = City::factory()->create();
    $dbCity = $this->cityRepo->find($city->id);
    $dbCity = $dbCity->toArray();
    $this->assertModelData($city->toArray(), $dbCity);
});

test('update city', function () {
    $city = City::factory()->create();
    $fakeCity = City::factory()->make()->toArray();
    $updatedCity = $this->cityRepo->update($fakeCity, $city->id);
    $this->assertModelData($fakeCity, $updatedCity->toArray());
    $dbCity = $this->cityRepo->find($city->id);
    $this->assertModelData($fakeCity, $dbCity->toArray());
});

test('delete city', function () {
    $city = City::factory()->create();
    $resp = $this->cityRepo->delete($city->id);
    $this->assertTrue($resp);
    $this->assertNull(City::find($city->id), 'City should not exist in DB');
});
