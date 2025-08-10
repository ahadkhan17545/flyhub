<?php

use App\Jobs\CreateTenantSubdomain;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Stancl\Tenancy\Contracts\TenantWithDatabase;

uses(Tests\TestCase::class, DatabaseTransactions::class);

test('handles creates dns record via cloudflare api', function () {
    Http::fake([
        'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
            'success' => true,
            'result' => [
                'id' => 'test-record-id',
                'name' => 'test-tenant.flyhub.com.br',
                'type' => 'A',
                'content' => '54.88.38.41'
            ]
        ], 200)
    ]);

    $tenant = Mockery::mock(TenantWithDatabase::class);
    $tenant->shouldReceive('getTenantKey')->andReturn('test-tenant');

    $job = new CreateTenantSubdomain($tenant);
    $job->handle();

    Http::assertSent(function ($request) {
        return $request->url() === 'https://api.cloudflare.com/client/v4/zones/' . env('CLOUDFLARE_ZONE_ID') . '/dns_records' &&
               $request->method() === 'POST' &&
               $request->data() === [
                   'type' => 'A',
                   'name' => 'test-tenant.flyhub.com.br',
                   'content' => '54.88.38.41',
                   'ttl' => 3600,
                   'priority' => 10,
                   'proxied' => true
               ];
    });
});

test('handles uses correct tenant key in dns record', function () {
    Http::fake([
        'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
            'success' => true
        ], 200)
    ]);

    $tenant = Mockery::mock(TenantWithDatabase::class);
    $tenant->shouldReceive('getTenantKey')->andReturn('my-company');

    $job = new CreateTenantSubdomain($tenant);
    $job->handle();

    Http::assertSent(function ($request) {
        return $request->data()['name'] === 'my-company.flyhub.com.br';
    });
});

test('handles uses cloudflare token from env', function () {
    Http::fake([
        'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
            'success' => true
        ], 200)
    ]);

    $tenant = Mockery::mock(TenantWithDatabase::class);
    $tenant->shouldReceive('getTenantKey')->andReturn('test-tenant');

    $job = new CreateTenantSubdomain($tenant);
    $job->handle();

    Http::assertSent(function ($request) {
        return $request->hasHeader('Authorization', 'Bearer ' . env('CLOUDFLARE_TOKEN'));
    });
});

test('handles uses zone id from env', function () {
    Http::fake([
        'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
            'success' => true
        ], 200)
    ]);

    $tenant = Mockery::mock(TenantWithDatabase::class);
    $tenant->shouldReceive('getTenantKey')->andReturn('test-tenant');

    $job = new CreateTenantSubdomain($tenant);
    $job->handle();

    Http::assertSent(function ($request) {
        return str_contains($request->url(), env('CLOUDFLARE_ZONE_ID'));
    });
});

test('handles sets correct dns record parameters', function () {
    Http::fake([
        'https://api.cloudflare.com/client/v4/zones/*/dns_records' => Http::response([
            'success' => true
        ], 200)
    ]);

    $tenant = Mockery::mock(TenantWithDatabase::class);
    $tenant->shouldReceive('getTenantKey')->andReturn('test-tenant');

    $job = new CreateTenantSubdomain($tenant);
    $job->handle();

    Http::assertSent(function ($request) {
        $data = $request->data();
        return $data['type'] === 'A' &&
               $data['content'] === '54.88.38.41' &&
               $data['ttl'] === 3600 &&
               $data['priority'] === 10 &&
               $data['proxied'] === true;
    });
});
