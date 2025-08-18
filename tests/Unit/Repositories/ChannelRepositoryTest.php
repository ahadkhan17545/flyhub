<?php

use App\Models\Tenant\Channel;
use App\Repositories\Tenant\ChannelRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->channelRepo = new ChannelRepository();
});

test('create channel', function () {
    $channel = Channel::factory()->make()->toArray();
    $createdChannel = $this->channelRepo->create($channel);
    $createdChannel = $createdChannel->toArray();
    $this->assertArrayHasKey('id', $createdChannel);
    $this->assertNotNull($createdChannel['id'], 'Created Channel must have id specified');
    $this->assertNotNull(Channel::find($createdChannel['id']), 'Channel with given id must be in DB');
    $this->assertModelData($channel, $createdChannel);
});

test('read channel', function () {
    $channel = Channel::factory()->create();
    $dbChannel = $this->channelRepo->find($channel->id);
    $dbChannel = $dbChannel->toArray();
    $this->assertModelData($channel->toArray(), $dbChannel);
});

test('update channel', function () {
    $channel = Channel::factory()->create();
    $fakeChannel = Channel::factory()->make()->toArray();
    $updatedChannel = $this->channelRepo->update($fakeChannel, $channel->id);
    $this->assertModelData($fakeChannel, $updatedChannel->toArray());
    $dbChannel = $this->channelRepo->find($channel->id);
    $this->assertModelData($fakeChannel, $dbChannel->toArray());
});

test('delete channel', function () {
    $channel = Channel::factory()->create();
    $resp = $this->channelRepo->delete($channel->id);
    $this->assertTrue($resp);
    $this->assertNull(Channel::find($channel->id), 'Channel should not exist in DB');
});
