<?php

use App\Models\Tenant\ChannelSyncResult;
use App\Observers\ChannelSyncResultObserver;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(Tests\TestCase::class, DatabaseTransactions::class);

test('updated sets status to complete when processed equals total', function () {
    $syncResult = \Mockery::mock(ChannelSyncResult::class);
    $syncResult->shouldReceive('wasChanged')->with('processed')->andReturn(true);
    $syncResult->shouldReceive('getAttribute')->with('processed')->andReturn(10);
    $syncResult->shouldReceive('getAttribute')->with('total')->andReturn(10);
    $syncResult->shouldReceive('update')->with(['status' => 'complete'])->once();

    $observer = new ChannelSyncResultObserver();
    $observer->updated($syncResult);
});

test('updated sets status to complete when processed exceeds total', function () {
    $syncResult = \Mockery::mock(ChannelSyncResult::class);
    $syncResult->shouldReceive('wasChanged')->with('processed')->andReturn(true);
    $syncResult->shouldReceive('getAttribute')->with('processed')->andReturn(15);
    $syncResult->shouldReceive('getAttribute')->with('total')->andReturn(10);
    $syncResult->shouldReceive('update')->with(['status' => 'complete'])->once();

    $observer = new ChannelSyncResultObserver();
    $observer->updated($syncResult);
});

test('updated does not change status when processed less than total', function () {
    $syncResult = \Mockery::mock(ChannelSyncResult::class);
    $syncResult->shouldReceive('wasChanged')->with('processed')->andReturn(true);
    $syncResult->shouldReceive('getAttribute')->with('processed')->andReturn(7);
    $syncResult->shouldReceive('getAttribute')->with('total')->andReturn(10);
    $syncResult->shouldReceive('update')->never();

    $observer = new ChannelSyncResultObserver();
    $observer->updated($syncResult);
});

test('updated does not change status when processed was not changed', function () {
    $syncResult = \Mockery::mock(ChannelSyncResult::class);
    $syncResult->shouldReceive('wasChanged')->with('processed')->andReturn(false);
    $syncResult->shouldReceive('update')->never();

    $observer = new ChannelSyncResultObserver();
    $observer->updated($syncResult);
});
