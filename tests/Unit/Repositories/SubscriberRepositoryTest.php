<?php

use App\Models\Tenant\Subscriber;

uses(Tests\TestCase::class);

test('create subscriber', function () {
    $subscriber = Subscriber::factory()->make()->toArray();
    $createdSubscriber = $this->subscriberRepo->create($subscriber);
    $createdSubscriber = $createdSubscriber->toArray();
    $this->assertArrayHasKey('id', $createdSubscriber);
    $this->assertNotNull($createdSubscriber['id'], 'Created Subscriber must have id specified');
    $this->assertNotNull(Subscriber::find($createdSubscriber['id']), 'Subscriber with given id must be in DB');
    $this->assertModelData($subscriber, $createdSubscriber);
});

test('read subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $dbSubscriber = $this->subscriberRepo->find($subscriber->id);
    $dbSubscriber = $dbSubscriber->toArray();
    $this->assertModelData($subscriber->toArray(), $dbSubscriber);
});

test('update subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $fakeSubscriber = Subscriber::factory()->make()->toArray();
    $updatedSubscriber = $this->subscriberRepo->update($fakeSubscriber, $subscriber->id);
    $this->assertModelData($fakeSubscriber, $updatedSubscriber->toArray());
    $dbSubscriber = $this->subscriberRepo->find($subscriber->id);
    $this->assertModelData($fakeSubscriber, $dbSubscriber->toArray());
});

test('delete subscriber', function () {
    $subscriber = Subscriber::factory()->create();
    $resp = $this->subscriberRepo->delete($subscriber->id);
    $this->assertTrue($resp);
    $this->assertNull(Subscriber::find($subscriber->id), 'Subscriber should not exist in DB');
});
