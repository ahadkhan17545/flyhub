<?php

use App\Jobs\Tenant\ChannelSendJob;
use App\Models\Tenant\Channel;
use App\Models\Tenant\ChannelSync;
use App\Models\Tenant\ChannelSyncResult;
use App\Integration\ChannelResource;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Mockery;

uses(Tests\TestCase::class, DatabaseTransactions::class);

test('handles updates status to in progress', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create([
        'status' => 'pending'
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);

    $mockResource->shouldReceive('updateStatus')
                 ->with($syncLog, 'in_progress')
                 ->once();
    $mockResource->shouldReceive('send')->andReturn(['success' => true]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn(null);

    $job->handle();

    $syncLog->refresh();
    $this->assertEquals('in_progress', $syncLog->status);
});

test('handles saves result when send succeeds', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id,
        'data' => json_encode(['test' => 'data'])
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andReturn(['success' => true, 'id' => 123]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn(null);

    $job->handle();

    $syncResult->refresh();
    $this->assertEquals('complete', $syncResult->status);
    $this->assertEquals(json_encode(['success' => true, 'id' => 123]), $syncResult->result);
});

test('handles increments processed column on success', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id,
        'processed' => 0
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andReturn(['success' => true]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn(null);

    $job->handle();

    $syncResult->refresh();
    $this->assertEquals(1, $syncResult->processed);
});

test('handles saves error and increments failed on exception', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id,
        'failed' => 0
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andThrow(new Exception('API Error'));

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn(null);

    $job->handle();

    $syncResult->refresh();
    $this->assertEquals('failed', $syncResult->status);
    $this->assertEquals('API Error', $syncResult->error);
    $this->assertEquals(1, $syncResult->failed);
});

test('handles dispatches next job when available', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id
    ]);

    $nextResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id,
        'data' => json_encode(['next' => 'item'])
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andReturn(['success' => true]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn($nextResult);

    $job->handle();

    Queue::assertPushed(ChannelSendJob::class);
});

test('handles updates status to complete when no next job', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andReturn(['success' => true]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn(null);

    $job->handle();

    $syncLog->refresh();
    $this->assertEquals('complete', $syncLog->status);
});

test('handles sets last send at when updated at exists', function () {
    Queue::fake();

    $channel = Channel::factory()->create();
    $syncLog = ChannelSync::factory()->create();
    $syncResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id,
        'data' => json_encode(['updated_at' => '2023-01-01 10:00:00'])
    ]);

    $nextResult = ChannelSyncResult::factory()->create([
        'channel_sync_id' => $syncLog->id
    ]);

    $mockResource = Mockery::mock(ChannelResource::class);
    $mockResource->shouldReceive('send')->andReturn(['success' => true]);

    $job = Mockery::mock(ChannelSendJob::class, [$channel, $syncLog, $syncResult])
        ->makePartial()
        ->shouldAllowMockingProtectedMethods();

    $job->shouldReceive('channelResource')->andReturn($mockResource);
    $job->shouldReceive('getNextJob')->andReturn($nextResult);
    $channel->shouldReceive('setLastSendAt')->with($syncLog->model, '2023-01-01 10:00:00');

    $job->handle();

    Queue::assertPushed(ChannelSendJob::class);
});
