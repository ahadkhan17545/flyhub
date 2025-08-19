<?php

use App\Models\Tenant\Channel;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates channel', function () {
    $channel = Channel::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/channels', $channel );
    $this->assertApiResponse($channel);
});

test('read_channel', function () {
    $channel = Channel::factory()->create();
    $this->response = $this->json( 'GET', '/api/channels/' . $channel->id );
    $this->assertApiResponse($channel->toArray());
});

test('update_channel', function () {
    $channel = Channel::factory()->create();
    $editedChannel = Channel::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/channels/' . $channel->id, $editedChannel );
    $this->assertApiResponse($editedChannel);
});

test('delete_channel', function () {
    $channel = Channel::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/channels/' . $channel->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/channels/' . $channel->id );
    $this->response->assertStatus(404);
});
