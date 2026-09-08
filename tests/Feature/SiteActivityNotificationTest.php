<?php

use App\Models\SecurityAssessment;
use App\Models\User;
use App\Notifications\NewUserRegistered;
use App\Notifications\SiteActionOccurred;
use App\Services\DnsLookup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

it('emails the configured recipient when a person registers', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    $this->mock(DnsLookup::class)->shouldReceive('hasMailServer')->once()->with('company.com')->andReturnTrue();

    $this->post(route('register'), [
        'name' => 'Ana Pérez',
        'email' => 'ana@company.com',
        'password' => 'my-long-password',
        'password_confirmation' => 'my-long-password',
        'terms' => '1',
    ])->assertRedirect(route('verification.notice'));

    Notification::assertSentOnDemand(
        NewUserRegistered::class,
        fn (NewUserRegistered $notification, array $channels, object $notifiable): bool => $channels === ['mail']
            && $notifiable->routes['mail'] === 'nadinyamaui@outlook.com'
            && $notification->name === 'Ana Pérez'
            && $notification->email === 'ana@company.com'
            && $notification->toMail($notifiable)->subject === '[Okanet] Nueva persona registrada',
    );
});

it('emails successful state-changing actions without including request secrets', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('logout'), [
        'password' => 'must-not-be-reported',
    ])->assertRedirect(route('home'));

    Notification::assertSentOnDemand(
        SiteActionOccurred::class,
        fn (SiteActionOccurred $notification, array $channels, object $notifiable): bool => $channels === ['mail']
            && $notifiable->routes['mail'] === 'nadinyamaui@outlook.com'
            && $notification->description === 'Cierre de sesión'
            && $notification->actorEmail === $user->email
            && $notification->method === 'POST'
            && $notification->routeName === 'logout'
            && ! str_contains(serialize($notification), 'must-not-be-reported'),
    );
});

it('emails successful report downloads', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    Storage::fake('reports');
    Storage::disk('reports')->put('private.pdf', '%PDF-1.4');
    $assessment = SecurityAssessment::factory()->authorized()->create([
        'status' => SecurityAssessment::Delivered,
        'report_path' => 'private.pdf',
        'delivered_at' => now(),
    ]);

    $this->actingAs($assessment->user)
        ->get(route('security.assessments.download', $assessment))
        ->assertDownload('informe-'.$assessment->domain.'.pdf');

    Notification::assertSentOnDemand(
        SiteActionOccurred::class,
        fn (SiteActionOccurred $notification): bool => $notification->description === 'Descarga de un informe de evaluación'
            && $notification->actorEmail === $assessment->user->email,
    );
});

it('does not email page views or failed actions', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();

    $this->get(route('home'))->assertOk();
    $this->post('/login', ['email' => 'invalid@example.com', 'password' => 'wrong'])
        ->assertSessionHasErrors('email');

    Notification::assertNothingSent();
});

it('emails a successful login after an earlier failed attempt', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    $user = User::factory()->create();

    $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])
        ->assertSessionHasErrors('email');
    $this->post('/login', ['email' => $user->email, 'password' => 'password'])
        ->assertRedirect(route('security.dashboard'));

    Notification::assertSentOnDemand(
        SiteActionOccurred::class,
        fn (SiteActionOccurred $notification): bool => $notification->description === 'Inicio de sesión'
            && $notification->actorEmail === $user->email
            && $notification->routeName === 'login.store',
    );
});

it('emails successful state changes made through the API', function (): void {
    config()->set('services.activity_notifications.enabled', true);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    $staff = User::factory()->staff()->create();
    Sanctum::actingAs($staff);

    $this->postJson(route('api.posts.store'), [
        'title' => 'Nueva publicación',
        'body' => 'Contenido de la publicación.',
        'published' => true,
    ])->assertCreated();

    Notification::assertSentOnDemand(
        SiteActionOccurred::class,
        fn (SiteActionOccurred $notification): bool => $notification->description === 'Creación de un artículo mediante la API'
            && $notification->actorEmail === $staff->email,
    );
});

it('can disable all operational notification emails through configuration', function (): void {
    config()->set('services.activity_notifications.enabled', false);
    config()->set('services.activity_notifications.recipient', 'nadinyamaui@outlook.com');
    Notification::fake();
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('logout'))->assertRedirect(route('home'));

    Notification::assertNothingSent();
});
