<?php

use App\Models\SecurityAssessment;
use App\Models\User;
use App\Notifications\AssessmentReportReady;
use App\Services\DnsLookup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('creates a unique domain challenge without creating an authorized task or running a scan', function (): void {
    Http::preventStrayRequests();
    $user = User::factory()->create();
    $this->actingAs($user)->post(route('security.assessments.store'), [
        'domain' => 'COMPANY.COM.', 'authorized_at' => now(), 'status' => 'requested', 'dns_verified_at' => now(),
    ])->assertRedirect();
    $assessment = SecurityAssessment::sole();
    expect($assessment->domain)->toBe('company.com');
    expect($assessment->status)->toBe(SecurityAssessment::PendingVerification);
    expect($assessment->dns_token)->toHaveLength(64);
    expect($assessment->authorized_at)->toBeNull();
    expect($assessment->dns_verified_at)->toBeNull();
    $this->post(route('security.assessments.store'), ['domain' => 'company.com'])->assertRedirect(route('security.assessments.show', $assessment));
    $this->assertDatabaseCount('security_assessments', 1);
    $this->get(route('security.assessments.show', $assessment))->assertOk()->assertSee('_okanet-verification.company.com')->assertSee($assessment->dns_token);
    $this->actingAs(User::factory()->staff()->create())->get(route('admin.assessments.index'))->assertDontSee('company.com');
    Http::assertNothingSent();
});

it('rejects unsafe or malformed domain input', function (string $domain): void {
    $this->actingAs(User::factory()->create())->post(route('security.assessments.store'), ['domain' => $domain])->assertSessionHasErrors('domain');
    $this->assertDatabaseCount('security_assessments', 0);
})->with(['https://company.com', '*.company.com', '127.0.0.1', 'localhost', 'company.com/path', 'foo.internal', 'foo.local', '-bad.com', 'foo..com', '<script>.com']);

it('verifies the exact TXT challenge then records explicit scoped authorization and a fixed deadline', function (): void {
    $this->travelTo(new DateTimeImmutable('2026-09-08 10:00:00 UTC'));
    $assessment = SecurityAssessment::factory()->for(User::factory()->create(['name' => 'Ana Pérez', 'email' => 'ana@company.com']))->create(['domain' => 'company.com']);
    $this->mock(DnsLookup::class)->shouldReceive('hasTxtRecord')->twice()->with('_okanet-verification.company.com', $assessment->dns_token)->andReturnTrue();
    $this->actingAs($assessment->user)->post(route('security.assessments.verify', $assessment))->assertRedirect();
    expect($assessment->refresh()->dns_verified_at)->not->toBeNull();
    expect($assessment->authorized_at)->toBeNull();
    $this->post(route('security.assessments.authorize', $assessment), ['authorization' => 1, 'domain' => 'other.com'])->assertRedirect();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::Requested);
    expect($assessment->due_at->toDateTimeString())->toBe('2026-09-10 10:00:00');
    expect($assessment->authorized_by)->toBe('Ana Pérez');
    expect($assessment->authorization_email)->toBe('ana@company.com');
    expect($assessment->authorization_text)->toContain('Dominio autorizado: company.com.');
    expect($assessment->authorization_ip)->toBe('127.0.0.1');
    $this->travel(1)->hours();
    $this->post(route('security.assessments.authorize', $assessment), ['authorization' => 1])->assertRedirect();
    expect($assessment->refresh()->due_at->toDateTimeString())->toBe('2026-09-10 10:00:00');
    $this->get(route('security.assessments.show', $assessment))->assertOk()->assertSee('10/09/2026 10:00');
});

it('refuses missing DNS proof absent consent and removed DNS records', function (): void {
    $assessment = SecurityAssessment::factory()->create();
    $this->actingAs($assessment->user)->post(route('security.assessments.authorize', $assessment), ['authorization' => 1])->assertSessionHasErrors('dns');
    $assessment->forceFill(['dns_verified_at' => now()])->save();
    $this->post(route('security.assessments.authorize', $assessment))->assertSessionHasErrors('authorization');
    $this->mock(DnsLookup::class)->shouldReceive('hasTxtRecord')->once()->andReturnFalse();
    $this->post(route('security.assessments.authorize', $assessment), ['authorization' => 1])->assertSessionHasErrors('dns');
    expect($assessment->refresh()->authorized_at)->toBeNull();
    expect($assessment->due_at)->toBeNull();
});

it('warns when the DNS challenge has not propagated', function (): void {
    $this->freezeTime();
    $assessment = SecurityAssessment::factory()->create();
    $this->mock(DnsLookup::class)->shouldReceive('hasTxtRecord')->once()->with($assessment->dnsName(), $assessment->dns_token)->andReturnFalse();

    $response = $this->actingAs($assessment->user)->post(route('security.assessments.verify', $assessment));

    $response->assertRedirect()->assertSessionHas('warning', 'Todavía no encontramos el registro TXT correcto. Revisa el nombre y el valor; la propagación puede tardar.');
    expect($assessment->refresh()->dns_verified_at)->toBeNull();
    $this->get(route('security.assessments.show', $assessment))
        ->assertSee('account-notice account-warning', false)
        ->assertSee('Todavía no encontramos el registro TXT correcto.');
});

it('rejects expired challenges and rotates expired tokens', function (): void {
    $this->freezeTime();
    $assessment = SecurityAssessment::factory()->create();
    $this->actingAs($assessment->user);

    $this->travel(8)->days();

    $this->post(route('security.assessments.verify', $assessment))->assertSessionHasErrors('dns');
    $oldToken = $assessment->dns_token;
    $this->post(route('security.assessments.renew', $assessment))->assertRedirect();
    expect($assessment->refresh()->dns_token)->not->toBe($oldToken);
    expect($assessment->dns_expires_at->isFuture())->toBeTrue();
    expect($assessment->dns_verified_at)->toBeNull();
});

it('allows staff to review upload and deliver a private PDF then records the full report request', function (): void {
    Storage::fake('reports');
    Notification::fake();
    $assessment = SecurityAssessment::factory()->authorized()->create(['domain' => 'company.com']);
    $staff = User::factory()->staff()->create();
    $this->actingAs($staff)->get(route('admin.assessments.show', $assessment))->assertOk()->assertSee('Alcance y autorización');
    $this->post(route('admin.assessments.start', $assessment))->assertRedirect();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::InProgress);
    $pdf = UploadedFile::fake()->createWithContent('report.pdf', "%PDF-1.4\n1 0 obj\n<< /Type /Catalog >>\nendobj\n%%EOF");
    $this->post(route('admin.assessments.upload', $assessment), ['summary' => 'Revisar configuración TLS.', 'report' => $pdf])->assertRedirect();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::ReportReady);
    expect($assessment->summary)->toBe('Revisar configuración TLS.');
    Storage::disk('reports')->assertExists($assessment->report_path);
    Notification::assertNothingSent();
    $this->get(route('admin.assessments.download', $assessment))->assertDownload('informe-company.com.pdf');
    $this->actingAs($assessment->user)->get(route('security.assessments.download', $assessment))->assertNotFound();
    $this->actingAs($staff)->post(route('admin.assessments.deliver', $assessment))->assertRedirect();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::Delivered);
    expect($assessment->delivered_at)->not->toBeNull();
    Notification::assertSentTo($assessment->user, AssessmentReportReady::class, fn ($notification) => $notification->assessmentId === $assessment->id);
    $this->post(route('admin.assessments.deliver', $assessment))->assertRedirect();
    Notification::assertSentToTimes($assessment->user, AssessmentReportReady::class, 1);
    $this->actingAs($assessment->user)->get(route('security.assessments.download', $assessment))
        ->assertDownload('informe-company.com.pdf')->assertHeader('X-Content-Type-Options', 'nosniff');
    $this->get(route('security.assessments.show', $assessment))->assertSee('Revisar configuración TLS.')->assertSee('Solicitar informe completo');
    $this->post(route('security.assessments.full-report', $assessment))->assertRedirect();
    expect($assessment->refresh()->full_report_requested_at)->not->toBeNull();
    $this->actingAs($staff)->get(route('admin.assessments.index'))->assertSee('company.com');
    $this->post(route('admin.assessments.followup', $assessment))->assertRedirect();
    expect($assessment->refresh()->followup_completed_at)->not->toBeNull();
});

it('rejects non PDF and oversized uploads without saving a report', function (): void {
    Storage::fake('reports');
    $assessment = SecurityAssessment::factory()->authorized()->create(['status' => SecurityAssessment::InProgress]);
    $this->actingAs(User::factory()->staff()->create())->post(route('admin.assessments.upload', $assessment), [
        'summary' => 'Summary', 'report' => UploadedFile::fake()->createWithContent('report.pdf', '<script>attack()</script>')->mimeType('text/html'),
    ])->assertSessionHasErrors('report');
    $this->post(route('admin.assessments.upload', $assessment), [
        'summary' => 'Summary', 'report' => UploadedFile::fake()->create('report.pdf', 10241, 'application/pdf'),
    ])->assertSessionHasErrors('report');
    expect($assessment->refresh()->report_path)->toBeNull();
    expect(Storage::disk('reports')->allFiles())->toBeEmpty();
});

it('blocks starting unauthorized or expired work and delivering without a report', function (): void {
    Notification::fake();
    $pending = SecurityAssessment::factory()->create();
    $expired = SecurityAssessment::factory()->authorized()->create(['due_at' => now()->subMinute()]);
    $this->actingAs(User::factory()->staff()->create())->post(route('admin.assessments.start', $pending))->assertSessionHasErrors('assessment');
    $this->post(route('admin.assessments.start', $expired))->assertSessionHasErrors('assessment');
    $this->post(route('admin.assessments.deliver', $pending))->assertConflict();
    expect($pending->refresh()->status)->toBe(SecurityAssessment::PendingVerification);
    expect($expired->refresh()->status)->toBe(SecurityAssessment::Requested);
    Notification::assertNothingSent();
});

it('escapes report summaries in staff and customer pages', function (): void {
    $assessment = SecurityAssessment::factory()->authorized()->create([
        'status' => SecurityAssessment::Delivered, 'summary' => '<script>alert(1)</script>',
        'report_path' => 'private.pdf', 'delivered_at' => now(),
    ]);
    $this->actingAs($assessment->user)->get(route('security.assessments.show', $assessment))
        ->assertSee('<script>alert(1)</script>')->assertDontSee('<script>alert(1)</script>', false);
    $this->actingAs(User::factory()->staff()->create())->get(route('admin.assessments.show', $assessment))
        ->assertSee('<script>alert(1)</script>')->assertDontSee('<script>alert(1)</script>', false);
});

it('keeps a report ready when the notification cannot be sent', function (): void {
    Exceptions::fake();
    Storage::fake('reports');
    Storage::disk('reports')->put('private.pdf', '%PDF-1.4');
    Notification::shouldReceive('send')->once()->andThrow(new RuntimeException('Mail unavailable'));
    $assessment = SecurityAssessment::factory()->authorized()->create([
        'status' => SecurityAssessment::ReportReady, 'report_path' => 'private.pdf', 'summary' => 'Review TLS.',
    ]);
    $this->actingAs(User::factory()->staff()->create())->post(route('admin.assessments.deliver', $assessment))->assertServerError();
    expect($assessment->refresh()->status)->toBe(SecurityAssessment::ReportReady);
    expect($assessment->delivered_at)->toBeNull();
    Exceptions::assertReported(RuntimeException::class);
});

it('returns not found for a report file missing from private storage', function (): void {
    Storage::fake('reports');
    $assessment = SecurityAssessment::factory()->authorized()->create([
        'status' => SecurityAssessment::Delivered, 'report_path' => 'missing.pdf',
    ]);
    $this->actingAs($assessment->user)->get(route('security.assessments.download', $assessment))->assertNotFound();
    $this->actingAs(User::factory()->staff()->create())->get(route('admin.assessments.download', $assessment))->assertNotFound();
    Storage::disk('reports')->assertMissing('missing.pdf');
});
