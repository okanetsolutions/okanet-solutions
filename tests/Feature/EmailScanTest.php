<?php

use App\Jobs\CheckEmailExposure;
use App\Models\EmailScan;
use App\Models\User;
use App\Services\Breachsense;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Sleep;

uses(RefreshDatabase::class);

beforeEach(function (): void {
    config([
        'services.breachsense.enabled' => true,
        'services.breachsense.key' => 'test-license',
        'services.breachsense.monthly_query_limit' => 10,
        'services.breachsense.endpoints' => ['creds'],
    ]);
    Sleep::fake(syncWithCarbon: true);
});

it('queues only the verified account email and deduplicates repeated submissions', function (): void {
    Queue::fake([CheckEmailExposure::class]);
    Http::preventStrayRequests();
    $user = User::factory()->create(['email' => 'ana@company.com']);
    $this->actingAs($user)->post(route('security.email.store'), ['consent' => 1, 'email' => 'victim@another.com', 'user_id' => 999])->assertRedirect(route('security.dashboard'));
    $this->post(route('security.email.store'), ['consent' => 1])->assertRedirect();
    $scan = EmailScan::sole();
    expect($scan->email)->toBe('ana@company.com');
    expect($scan->user_id)->toBe($user->id);
    Queue::assertPushed(CheckEmailExposure::class, fn ($job) => $job->scanId === $scan->id);
    Queue::assertPushed(CheckEmailExposure::class, 1);
    Http::assertNothingSent();
});

it('requires lookup consent and a configured service before dispatch', function (): void {
    Queue::fake();
    $this->actingAs(User::factory()->create())->post(route('security.email.store'))->assertSessionHasErrors('consent');
    config(['services.breachsense.enabled' => false]);
    $this->post(route('security.email.store'), ['consent' => 1])->assertSessionHasErrors('scan');
    $this->assertDatabaseCount('email_scans', 0);
    Queue::assertNothingPushed();
});

it('stores a validated exposure count and renders a masked result', function (mixed $payload, int $expected): void {
    Http::preventStrayRequests();
    Http::fake(['https://api.breachsense.com/creds*' => Http::response($payload)]);
    $scan = EmailScan::factory()->for(User::factory()->create(['email' => 'ana@company.com']))->create();
    $job = new CheckEmailExposure($scan->id);
    $job->handle(app(Breachsense::class));
    $job->handle(app(Breachsense::class));
    expect($scan->refresh()->status)->toBe(EmailScan::Completed);
    expect($scan->exposure_count)->toBe($expected);
    Http::assertSentCount(1);
    Http::assertSent(fn ($request) => $request->hasHeader('lic', 'test-license') && $request['s'] === 'ana@company.com' && $request['count'] === 1 && ! str_contains($request->url(), 'test-license'));
    $this->actingAs($scan->user)->get(route('security.dashboard'))->assertOk()->assertSee('a***@company.com')->assertSee('Solicitar más información')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
})->with([
    'scalar' => ['3', 3], 'zero' => ['0', 0], 'count object' => [['cnt' => 2], 2], 'count list' => [[['cnt' => 1]], 1],
]);

it('combines counts from the configured credential exposure endpoints', function (): void {
    config(['services.breachsense.endpoints' => ['creds', 'stealer', 'combo']]);
    $counts = ['creds' => 1, 'stealer' => 2, 'combo' => 3];
    Http::preventStrayRequests();
    Http::fake(function ($request) use ($counts) {
        $endpoint = basename(parse_url($request->url(), PHP_URL_PATH));

        return Http::response(['cnt' => $counts[$endpoint]]);
    });
    $scan = EmailScan::factory()->for(User::factory()->create(['email' => 'ana@company.com']))->create();

    (new CheckEmailExposure($scan->id))->handle(app(Breachsense::class));

    expect($scan->refresh()->exposure_count)->toBe(6);
    Http::assertSentCount(3);
    foreach (array_keys($counts) as $endpoint) {
        Http::assertSent(fn ($request) => $request->url() === 'https://api.breachsense.com/'.$endpoint.'?s=ana%40company.com&count=1'
            && $request->hasHeader('lic', 'test-license'));
    }
    Sleep::assertSleptTimes(2);
});

it('rejects unsupported configured endpoints before sending data', function (): void {
    config(['services.breachsense.endpoints' => ['creds', 'account']]);
    Http::preventStrayRequests();

    expect(fn () => app(Breachsense::class)->exposureCount('ana@company.com'))
        ->toThrow(RuntimeException::class, 'unsupported email endpoint');

    Http::assertNothingSent();
});

it('never treats malformed partial or failed provider results as a clean scan', function (mixed $body, int $status): void {
    Http::preventStrayRequests();
    Http::fake(['https://api.breachsense.com/creds*' => Http::response($body, $status)]);
    $scan = EmailScan::factory()->create();
    $job = new CheckEmailExposure($scan->id);
    expect(fn () => $job->handle(app(Breachsense::class)))->toThrow(RuntimeException::class);
    $job->failed(null);
    expect($scan->refresh()->status)->toBe(EmailScan::Failed);
    expect($scan->exposure_count)->toBeNull();
    Http::assertSentCount(1);
    $this->actingAs($scan->user)->get(route('security.dashboard'))->assertSee('No pudimos completar la consulta')->assertDontSee('No encontramos exposición.')->assertDontSee('leaked-password');
})->with([
    'rate limit' => [['error' => true], 429], 'bad key' => [[], 401], 'unlicensed' => [[], 403],
    'server error' => [[], 500], 'partial' => [['cnt' => 0], 206], 'missing count' => [[], 200],
    'credentials' => [[['pwd' => 'leaked-password']], 200], 'negative count' => [['cnt' => -1], 200],
    'false count' => [['cnt' => false], 200], 'error with count' => [['cnt' => 0, 'error' => true], 200],
    'invalid json' => ['upstream error', 200],
]);

it('rechecks email verification and account email before contacting the provider', function (bool $verified): void {
    Http::preventStrayRequests();
    $user = User::factory()->create(['email_verified_at' => $verified ? now() : null]);
    $scan = EmailScan::factory()->for($user)->create(['email' => $verified ? 'previous@company.com' : $user->email]);
    (new CheckEmailExposure($scan->id))->handle(app(Breachsense::class));
    expect($scan->refresh()->status)->toBe(EmailScan::Failed);
    Http::assertNothingSent();
})->with([true, false]);

it('stops at the local monthly query budget', function (): void {
    config(['services.breachsense.monthly_query_limit' => 1]);
    Http::preventStrayRequests();
    Http::fake(['https://api.breachsense.com/creds*' => Http::response('1')]);
    $first = EmailScan::factory()->create();
    $second = EmailScan::factory()->create();
    (new CheckEmailExposure($first->id))->handle(app(Breachsense::class));
    expect(fn () => (new CheckEmailExposure($second->id))->handle(app(Breachsense::class)))->toThrow(RuntimeException::class, 'monthly budget exhausted');
    Http::assertSentCount(1);
    expect($second->refresh()->exposure_count)->toBeNull();
});

it('records a details request once and exposes it to staff for followup', function (): void {
    $this->freezeTime();
    $scan = EmailScan::factory()->completed()->create();
    $this->actingAs($scan->user)->post(route('security.email.details', $scan))->assertRedirect();
    $requestedAt = $scan->refresh()->details_requested_at->toDateTimeString();
    $this->travel(1)->minutes();
    $this->post(route('security.email.details', $scan))->assertRedirect();
    expect($scan->refresh()->details_requested_at->toDateTimeString())->toBe($requestedAt);
    $this->actingAs(User::factory()->staff()->create())->get(route('admin.assessments.index'))->assertOk()->assertSee($scan->email);
    $this->post(route('admin.email.followup', $scan))->assertRedirect();
    expect($scan->refresh()->followup_completed_at)->not->toBeNull();
});

it('allows retry of failed lookups but never reruns completed free checks', function (): void {
    Queue::fake([CheckEmailExposure::class]);
    $scan = EmailScan::factory()->create(['status' => EmailScan::Failed]);
    $this->actingAs($scan->user)->post(route('security.email.store'), ['consent' => 1])->assertRedirect();
    expect($scan->refresh()->status)->toBe(EmailScan::Queued);
    Queue::assertPushed(CheckEmailExposure::class, 1);
    $scan->forceFill(['status' => EmailScan::Completed, 'exposure_count' => 1, 'checked_at' => now()])->save();
    $this->post(route('security.email.store'), ['consent' => 1])->assertRedirect();
    Queue::assertPushed(CheckEmailExposure::class, 1);
});

it('makes a queue dispatch failure visible and retryable', function (): void {
    Exceptions::fake();
    Queue::shouldReceive('connection')->andThrow(new RuntimeException('Queue unavailable'));
    $this->actingAs(User::factory()->create())->post(route('security.email.store'), ['consent' => 1])->assertSessionHasErrors('scan');
    expect(EmailScan::sole()->status)->toBe(EmailScan::Failed);
    Exceptions::assertReported(RuntimeException::class);
});

it('masks the complete local part when a quoted email contains an at sign', function (): void {
    $user = User::factory()->create(['email' => '"ana@private"@company.com']);
    EmailScan::factory()->completed()->for($user)->create();
    $this->actingAs($user)->get(route('security.dashboard'))->assertOk()->assertSee('"***@company.com')->assertDontSee('ana@private');
});
