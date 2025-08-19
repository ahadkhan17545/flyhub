<?php

use App\Models\Tenant\User;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

beforeEach(function () { $this->markTestSkipped('API layer not configured (routes/controllers).'); });

test('creates user', function () {
    $user = User::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/users', $user );
    $this->assertApiResponse($user);
});

test('reads user', function () {
    $user = User::factory()->create();
    $this->response = $this->json( 'GET', '/api/users/' . $user->id );
    $this->assertApiResponse($user->toArray());
});

test('updates user', function () {
    $user = User::factory()->create();
    $editedUser = User::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/users/' . $user->id, $editedUser );
    $this->assertApiResponse($editedUser);
});

test('deletes user', function () {
    $user = User::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/users/' . $user->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/users/' . $user->id );
    $this->response->assertStatus(404);
});
