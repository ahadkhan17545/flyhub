<?php

use App\Models\Tenant\Config;

uses(Tests\TestCase::class);

test('create config', function () {
    $config = Config::factory()->make()->toArray();
    $createdConfig = $this->configRepo->create($config);
    $createdConfig = $createdConfig->toArray();
    $this->assertArrayHasKey('id', $createdConfig);
    $this->assertNotNull($createdConfig['id'], 'Created Config must have id specified');
    $this->assertNotNull(Config::find($createdConfig['id']), 'Config with given id must be in DB');
    $this->assertModelData($config, $createdConfig);
});

test('read config', function () {
    $config = Config::factory()->create();
    $dbConfig = $this->configRepo->find($config->id);
    $dbConfig = $dbConfig->toArray();
    $this->assertModelData($config->toArray(), $dbConfig);
});

test('update config', function () {
    $config = Config::factory()->create();
    $fakeConfig = Config::factory()->make()->toArray();
    $updatedConfig = $this->configRepo->update($fakeConfig, $config->id);
    $this->assertModelData($fakeConfig, $updatedConfig->toArray());
    $dbConfig = $this->configRepo->find($config->id);
    $this->assertModelData($fakeConfig, $dbConfig->toArray());
});

test('delete config', function () {
    $config = Config::factory()->create();
    $resp = $this->configRepo->delete($config->id);
    $this->assertTrue($resp);
    $this->assertNull(Config::find($config->id), 'Config should not exist in DB');
});
