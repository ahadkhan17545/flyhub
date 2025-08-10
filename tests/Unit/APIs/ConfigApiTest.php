<?php

use App\Models\Tenant\Config;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates config', function () {
    $config = Config::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/configs', $config );
    $this->assertApiResponse($config);
});

test('reads config', function () {
    $config = Config::factory()->create();
    $this->response = $this->json( 'GET', '/api/configs/' . $config->id );
    $this->assertApiResponse($config->toArray());
});

test('updates config', function () {
    $config = Config::factory()->create();
    $editedConfig = Config::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/configs/' . $config->id, $editedConfig );
    $this->assertApiResponse($editedConfig);
});

test('deletes config', function () {
    $config = Config::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/configs/' . $config->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/configs/' . $config->id );
    $this->response->assertStatus(404);
});
