<?php

use App\Models\Tenant\User;
use App\Repositories\Tenant\UserRepository;

uses(Tests\TestCase::class);

beforeEach(function () {
    $this->userRepo = new UserRepository();
});

test('create user', function () {
    $user = User::factory()->make()->makeVisible(['password'])->toArray();
    $createdUser = $this->userRepo->create($user);
    $createdUser = $createdUser->toArray();
    $this->assertArrayHasKey('id', $createdUser);
    $this->assertNotNull($createdUser['id'], 'Created User must have id specified');
    $this->assertNotNull(User::find($createdUser['id']), 'User with given id must be in DB');

    // Remove password from comparison since it gets hashed
    unset($user['password']);
    $this->assertModelData($user, $createdUser);
});

test('read user', function () {
    $user = User::factory()->create();
    $dbUser = $this->userRepo->find($user->id);
    $dbUser = $dbUser->toArray();
    $this->assertModelData($user->toArray(), $dbUser);
});

test('update user', function () {
    $user = User::factory()->create();
    $fakeUser = User::factory()->make()->toArray();
    $updatedUser = $this->userRepo->update($fakeUser, $user->id);
    $this->assertModelData($fakeUser, $updatedUser->toArray());
    $dbUser = $this->userRepo->find($user->id);
    $this->assertModelData($fakeUser, $dbUser->toArray());
});

test('delete user', function () {
    $user = User::factory()->create();
    $resp = $this->userRepo->delete($user->id);
    $this->assertTrue($resp);
    $this->assertNull($this->userRepo->find($user->id), 'User should not exist in DB');
});
