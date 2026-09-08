<?php

use App\Models\EmailScan;
use App\Models\Post;
use App\Models\SecurityAssessment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('requires verified login for every customer scan and assessment action', function (string $routeName, string $method, string $parameter): void {
    Queue::fake();
    Http::preventStrayRequests();
    $user = User::factory()->unverified()->create();
    $assessment = SecurityAssessment::factory()->for($user)->create();
    $scan = EmailScan::factory()->for($user)->create();
    $url = route($routeName, match ($parameter) {
        'assessment' => $assessment, 'scan' => $scan, default => []
    });
    $this->{$method}($url)->assertRedirect(route('login'));
    $this->actingAs($user)->{$method}($url)->assertRedirect(route('verification.notice'));
    expect($assessment->refresh()->authorized_at)->toBeNull();
    expect($scan->refresh()->exposure_count)->toBeNull();
    Queue::assertNothingPushed();
    Http::assertNothingSent();
})->with([
    ['security.dashboard', 'get', ''], ['security.email.store', 'post', ''], ['security.email.details', 'post', 'scan'],
    ['security.assessments.store', 'post', ''], ['security.assessments.show', 'get', 'assessment'],
    ['security.assessments.verify', 'post', 'assessment'], ['security.assessments.renew', 'post', 'assessment'],
    ['security.assessments.authorize', 'post', 'assessment'], ['security.assessments.download', 'get', 'assessment'],
    ['security.assessments.full-report', 'post', 'assessment'],
]);

it('hides other customers assessments and rejects every cross-account action', function (string $routeName, string $method): void {
    $assessment = SecurityAssessment::factory()->authorized()->create([
        'status' => SecurityAssessment::Delivered, 'summary' => 'Private findings', 'report_path' => 'private.pdf',
    ]);
    $this->actingAs(User::factory()->create())->{$method}(route($routeName, $assessment))->assertNotFound();
    expect($assessment->refresh()->full_report_requested_at)->toBeNull();
})->with([
    ['security.assessments.show', 'get'], ['security.assessments.verify', 'post'], ['security.assessments.renew', 'post'],
    ['security.assessments.authorize', 'post'], ['security.assessments.download', 'get'], ['security.assessments.full-report', 'post'],
]);

it('limits the dashboard and exposure followup to the current customer', function (): void {
    $otherAssessment = SecurityAssessment::factory()->create(['domain' => 'private-customer.com']);
    $otherScan = EmailScan::factory()->completed()->for($otherAssessment->user)->create();
    $this->actingAs(User::factory()->create())->get(route('security.dashboard'))->assertOk()->assertDontSee('private-customer.com')->assertDontSee($otherScan->maskedEmail());
    $this->post(route('security.email.details', $otherScan))->assertNotFound();
    expect($otherScan->refresh()->details_requested_at)->toBeNull();
});

it('blocks customers from all assessment administration routes', function (string $routeName, string $method, string $parameter): void {
    Storage::fake('reports');
    $assessment = SecurityAssessment::factory()->authorized()->create();
    $scan = EmailScan::factory()->completed()->create();
    $url = route($routeName, match ($parameter) {
        'assessment' => $assessment, 'scan' => $scan, default => []
    });
    $this->actingAs(User::factory()->create())->{$method}($url)->assertForbidden();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::Requested);
    expect($scan->refresh()->followup_completed_at)->toBeNull();
    expect(Storage::disk('reports')->allFiles())->toBeEmpty();
})->with([
    ['admin.assessments.index', 'get', ''], ['admin.assessments.show', 'get', 'assessment'],
    ['admin.assessments.start', 'post', 'assessment'], ['admin.assessments.upload', 'post', 'assessment'],
    ['admin.assessments.deliver', 'post', 'assessment'], ['admin.assessments.download', 'get', 'assessment'],
    ['admin.assessments.followup', 'post', 'assessment'], ['admin.email.followup', 'post', 'scan'],
]);

it('blocks customer blog administration and draft access on the web and API', function (): void {
    $customer = User::factory()->create();
    $draft = Post::factory()->draft()->create(['title' => 'Private draft']);
    $this->actingAs($customer)->get(route('admin.posts.index'))->assertForbidden();
    $this->post(route('admin.posts.store'), ['title' => 'Injected', 'body' => 'Injected'])->assertForbidden();
    $this->put(route('admin.posts.update', $draft), ['title' => 'Injected', 'body' => 'Injected'])->assertForbidden();
    $this->delete(route('admin.posts.destroy', $draft))->assertForbidden();
    $this->get(route('blog.show', $draft))->assertNotFound();
    Sanctum::actingAs($customer);
    $this->getJson('/api/posts?include=drafts')->assertOk()->assertJsonCount(0, 'data');
    $this->getJson(route('api.posts.show', $draft))->assertNotFound();
    $this->postJson(route('api.posts.store'), ['title' => 'Injected', 'body' => 'Injected'])->assertForbidden();
    $this->putJson(route('api.posts.update', $draft), ['title' => 'Injected', 'body' => 'Injected'])->assertForbidden();
    $this->deleteJson(route('api.posts.destroy', $draft))->assertForbidden();
    expect($draft->refresh()->title)->toBe('Private draft');
    $this->assertDatabaseCount('posts', 1);
});

it('grants and revokes staff access only through the administration command', function (): void {
    $user = User::factory()->create();
    $this->artisan('security:staff', ['email' => $user->email])->assertSuccessful();
    expect($user->refresh()->is_staff)->toBeTrue();
    $this->artisan('security:staff', ['email' => $user->email, '--revoke' => true])->assertSuccessful();
    expect($user->refresh()->is_staff)->toBeFalse();
    $this->artisan('security:staff', ['email' => 'missing@company.com'])->assertFailed();
});

it('keeps the internal staff flag out of the existing API profile contract', function (): void {
    $staff = User::factory()->staff()->create();
    Sanctum::actingAs($staff);
    $this->getJson(route('api.user'))->assertOk()->assertJsonPath('email', $staff->email)->assertJsonMissingPath('is_staff');
});
