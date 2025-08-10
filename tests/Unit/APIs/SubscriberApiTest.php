<?php

use App\Models\Tenant\Subscriber;

uses(Tests\TestCase::class, Tests\ApiTestTrait::class);

test('creates subscriber', function () {
    $subscriber = Subscriber::factory()->make()->toArray();
    $this->response = $this->json( 'POST', '/api/subscribers', $subscriber );
    $this->assertApiResponse($subscriber);
});

test('reads subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $this->response = $this->json( 'GET', '/api/subscribers/' . $subscriber->id );
    $this->assertApiResponse($subscriber->toArray());
});

test('updates subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $editedSubscriber = Subscriber::factory()->make()->toArray();
    $this->response = $this->json( 'PUT', '/api/subscribers/' . $subscriber->id, $editedSubscriber );
    $this->assertApiResponse($editedSubscriber);
});

test('deletes subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $this->response = $this->json( 'DELETE', '/api/subscribers/' . $subscriber->id );
    $this->assertApiSuccess();
    $this->response = $this->json( 'GET', '/api/subscribers/' . $subscriber->id );
    $this->response->assertStatus(404);
});
