<?php

use App\Models\Tenant\State;
use App\Repositories\Tenant\StateRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->stateRepo = new StateRepository();
});

test('create state', function () {
    $state = State::factory()->make()->toArray();
    $createdState = $this->stateRepo->create($state);
    $createdState = $createdState->toArray();
    $this->assertArrayHasKey('id', $createdState);
    $this->assertNotNull($createdState['id'], 'Created State must have id specified');
    $this->assertNotNull(State::find($createdState['id']), 'State with given id must be in DB');
    $this->assertModelData($state, $createdState);
});

test('read state', function () {
    $state = State::factory()->create();
    $dbState = $this->stateRepo->find($state->id);
    $dbState = $dbState->toArray();
    $this->assertModelData($state->toArray(), $dbState);
});

test('update state', function () {
    $state = State::factory()->create();
    $fakeState = State::factory()->make()->toArray();
    $updatedState = $this->stateRepo->update($fakeState, $state->id);
    $this->assertModelData($fakeState, $updatedState->toArray());
    $dbState = $this->stateRepo->find($state->id);
    $this->assertModelData($fakeState, $dbState->toArray());
});

test('delete state', function () {
    $state = State::factory()->create();
    $resp = $this->stateRepo->delete($state->id);
    $this->assertTrue($resp);
    $this->assertNull($this->stateRepo->find($state->id), 'State should not exist in DB');
});
