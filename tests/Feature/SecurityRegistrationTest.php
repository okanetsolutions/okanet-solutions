<?php

use App\Models\User;
use App\Services\DnsLookup;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\URL;

uses(RefreshDatabase::class);

it('registers a corporate customer and sends Laravel verification without starting a scan', function (): void {
    Notification::fake();
    Queue::fake();
    Http::preventStrayRequests();
    $this->mock(DnsLookup::class)->shouldReceive('hasMailServer')->once()->with('company.com')->andReturnTrue();

    $this->post(route('register'), [
        'name' => 'Ana Pérez', 'email' => 'ANA@COMPANY.COM',
        'password' => 'my-long-password', 'password_confirmation' => 'my-long-password', 'terms' => '1',
        'is_staff' => true, 'email_verified_at' => now()->toDateTimeString(),
    ])->assertRedirect(route('verification.notice'));

    $user = User::sole();
    expect($user->email)->toBe('ana@company.com');
    expect($user->is_staff)->toBeFalse();
    expect($user->hasVerifiedEmail())->toBeFalse();
    expect(Hash::check('my-long-password', $user->password))->toBeTrue();
    $this->assertAuthenticatedAs($user);
    Notification::assertSentTo($user, VerifyEmail::class);
    Queue::assertNothingPushed();
    Http::assertNothingSent();
    $this->get(route('security.dashboard'))->assertRedirect(route('verification.notice'));
});

it('rejects personal disposable and invalid registration emails', function (string $email): void {
    Notification::fake();
    $this->post(route('register'), [
        'name' => 'Ana', 'email' => $email, 'password' => 'my-long-password',
        'password_confirmation' => 'my-long-password', 'terms' => '1',
    ])->assertSessionHasErrors('email');
    $this->assertDatabaseCount('users', 0);
    Notification::assertNothingSent();
})->with(['ana@gmail.com', 'ana@OUTLOOK.COM', 'ana@mailinator.com', 'ana@sub.yopmail.com', 'not-an-email']);

it('rejects corporate addresses without a working mail domain', function (): void {
    $this->mock(DnsLookup::class)->shouldReceive('hasMailServer')->with('company.com')->andReturnFalse();
    $this->post(route('register'), [
        'name' => 'Ana', 'email' => 'ana@company.com', 'password' => 'my-long-password',
        'password_confirmation' => 'my-long-password', 'terms' => '1',
    ])->assertSessionHasErrors(['email' => 'El dominio de tu correo debe tener un servidor de correo válido.']);
    $this->assertDatabaseCount('users', 0);
});

it('requires matching secure passwords and accepted terms', function (): void {
    $this->mock(DnsLookup::class)->shouldReceive('hasMailServer')->andReturnTrue();
    $this->post(route('register'), [
        'name' => 'Ana', 'email' => 'ana@company.com', 'password' => 'short', 'password_confirmation' => 'different',
    ])->assertSessionHasErrors(['password', 'terms']);
    $this->assertDatabaseCount('users', 0);
});

it('verifies an authenticated account with the signed Laravel link without scanning', function (): void {
    Queue::fake();
    Http::preventStrayRequests();
    $user = User::factory()->unverified()->create();
    $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
        'id' => $user->id, 'hash' => sha1($user->email),
    ]);
    $this->actingAs($user)->get($url)->assertRedirect(route('security.dashboard'));
    expect($user->refresh()->hasVerifiedEmail())->toBeTrue();
    Queue::assertNothingPushed();
    Http::assertNothingSent();
});

it('rejects expired tampered or other-account verification links', function (string $kind): void {
    $this->freezeTime();
    $user = User::factory()->unverified()->create();
    $other = User::factory()->unverified()->create();
    $url = URL::temporarySignedRoute('verification.verify', $kind === 'expired' ? now()->subMinute() : now()->addHour(), [
        'id' => $kind === 'other' ? $other->id : $user->id,
        'hash' => sha1($kind === 'other' ? $other->email : $user->email),
    ]);
    if ($kind === 'tampered') {
        $url .= '&tampered=1';
    }
    $this->actingAs($user)->get($url)->assertForbidden();
    expect($user->refresh()->hasVerifiedEmail())->toBeFalse();
    expect($other->refresh()->hasVerifiedEmail())->toBeFalse();
})->with(['expired', 'tampered', 'other']);

it('resends verification with a rate limit and skips already verified accounts', function (): void {
    Notification::fake();
    $user = User::factory()->unverified()->create();
    $this->actingAs($user);
    foreach (range(1, 3) as $attempt) {
        $this->post(route('verification.send'))->assertRedirect();
    }
    $this->post(route('verification.send'))->assertTooManyRequests();
    Notification::assertSentToTimes($user, VerifyEmail::class, 3);
});

it('provides password recovery without exposing account existence', function (): void {
    Notification::fake();
    $user = User::factory()->create();
    $response = $this->post(route('password.email'), ['email' => $user->email])->assertRedirect();
    $status = session('status');
    $this->post(route('password.email'), ['email' => 'unknown@company.com'])->assertRedirect()->assertSessionHas('status', $status);
    Notification::assertSentTo($user, ResetPassword::class);
});

it('resets a password with a valid token and revokes API credentials', function (): void {
    $user = User::factory()->create();
    $user->createToken('old-device');
    $token = Password::createToken($user);
    $this->post(route('password.update'), [
        'token' => $token, 'email' => $user->email,
        'password' => 'replacement-password', 'password_confirmation' => 'replacement-password',
    ])->assertRedirect(route('login'));
    expect(Hash::check('replacement-password', $user->refresh()->password))->toBeTrue();
    expect($user->tokens()->count())->toBe(0);
    $this->post(route('password.update'), [
        'token' => $token, 'email' => $user->email,
        'password' => 'another-password', 'password_confirmation' => 'another-password',
    ])->assertSessionHasErrors('email');
    expect(Hash::check('replacement-password', $user->refresh()->password))->toBeTrue();
});

it('routes customers to their dashboard and signs them out', function (): void {
    $user = User::factory()->create();
    $this->post(route('login'), ['email' => $user->email, 'password' => 'password'])->assertRedirect(route('security.dashboard'));
    $this->get(route('security.dashboard'))->assertOk()->assertSee('Conoce tu exposición.');
    $this->post(route('logout'))->assertRedirect(route('home'));
    $this->assertGuest();
});

it('renders registration recovery and verification screens privately', function (): void {
    $this->get(route('register'))->assertOk()->assertSee('Crear cuenta y verificar correo')->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    $this->get(route('password.request'))->assertOk();
    $this->get(route('password.reset', ['token' => 'test-token', 'email' => 'ana@company.com']))->assertOk();
    $this->actingAs(User::factory()->unverified()->create())->get(route('verification.notice'))->assertOk()->assertSee('Revisa tu correo.');
});

it('links the security offers to registration or the authenticated customer dashboard', function (): void {
    $this->get(route('security'))->assertOk()->assertSee(route('register'), false)->assertSee('Consultar mi correo')->assertSee('Solicitar evaluación');
    $this->actingAs(User::factory()->create())->get(route('security'))->assertOk()->assertSee(route('security.dashboard'), false);
});
