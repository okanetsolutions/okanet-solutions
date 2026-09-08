<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

it('redirects guests from user management to login', function (): void {
    $this->get(route('admin.users.index'))->assertRedirect(route('login'));
});

it('forbids customers from every user management endpoint', function (string $routeName, string $method): void {
    $customer = User::factory()->create();
    $user = User::factory()->create();
    $url = route($routeName, $routeName === 'admin.users.index' ? [] : $user);

    $this->actingAs($customer)->call(strtoupper($method), $url, [
        'name' => 'Injected Name',
        'email' => 'injected@company.com',
        'is_staff' => '1',
    ])->assertForbidden();

    expect($user->refresh()->name)->not->toBe('Injected Name');
    expect($user->is_staff)->toBeFalse();
})->with([
    'list' => ['admin.users.index', 'get'],
    'edit' => ['admin.users.edit', 'get'],
    'update' => ['admin.users.update', 'put'],
]);

it('lists filters and escapes users for staff', function (): void {
    $staff = User::factory()->staff()->create();
    User::factory()->create(['name' => '<script>alert(1)</script> Ana', 'email' => 'ana@company.com']);
    User::factory()->create(['name' => 'Bruno Díaz', 'email' => 'bruno@company.com']);

    $this->actingAs($staff)->get(route('admin.users.index', ['search' => 'Ana']))
        ->assertOk()
        ->assertSee('ana@company.com')
        ->assertSee('<script>alert(1)</script> Ana')
        ->assertDontSee('<script>alert(1)</script> Ana', false)
        ->assertDontSee('bruno@company.com');
});

it('shows the user profile editor to staff', function (): void {
    $staff = User::factory()->staff()->create();
    $user = User::factory()->create(['name' => 'Ana Pérez', 'email' => 'ana@company.com']);

    $this->actingAs($staff)->get(route('admin.users.edit', $user))
        ->assertOk()
        ->assertSee('Ana Pérez')
        ->assertSee('ana@company.com')
        ->assertSee('Administrador');
});

it('updates a user and resets verification when the email changes', function (): void {
    $staff = User::factory()->staff()->create();
    $user = User::factory()->staff()->create([
        'name' => 'Original Name',
        'email' => 'original@company.com',
        'password' => bcrypt('original-password'),
    ]);

    $this->actingAs($staff)->put(route('admin.users.update', $user), [
        'name' => 'Updated Name',
        'email' => ' UPDATED@COMPANY.COM ',
        'is_staff' => '0',
        'password' => 'injected-password',
    ])->assertRedirect(route('admin.users.edit', $user))
        ->assertSessionHas('status', 'Usuario actualizado.');

    $user->refresh();
    expect($user->name)->toBe('Updated Name');
    expect($user->email)->toBe('updated@company.com');
    expect($user->is_staff)->toBeFalse();
    expect($user->email_verified_at)->toBeNull();
    expect(Hash::check('original-password', $user->password))->toBeTrue();
});

it('grants staff access without changing email verification', function (): void {
    $staff = User::factory()->staff()->create();
    $user = User::factory()->create();
    $verifiedAt = $user->email_verified_at;

    $this->actingAs($staff)->put(route('admin.users.update', $user), [
        'name' => $user->name,
        'email' => $user->email,
        'is_staff' => '1',
    ])->assertRedirect(route('admin.users.edit', $user));

    $user->refresh();
    expect($user->is_staff)->toBeTrue();
    expect($user->email_verified_at->equalTo($verifiedAt))->toBeTrue();
});

it('prevents staff from revoking their own access', function (): void {
    $staff = User::factory()->staff()->create();

    $this->actingAs($staff)->from(route('admin.users.edit', $staff))->put(route('admin.users.update', $staff), [
        'name' => $staff->name,
        'email' => $staff->email,
        'is_staff' => '0',
    ])->assertRedirect(route('admin.users.edit', $staff))
        ->assertSessionHasErrors(['is_staff' => 'No puedes retirar tu propio acceso de administrador.']);

    expect($staff->refresh()->is_staff)->toBeTrue();
});

it('rejects an email address already used by another account', function (): void {
    $staff = User::factory()->staff()->create();
    $user = User::factory()->create(['email' => 'first@company.com']);
    User::factory()->create(['email' => 'existing@company.com']);

    $this->actingAs($staff)->from(route('admin.users.edit', $user))->put(route('admin.users.update', $user), [
        'name' => 'Changed Name',
        'email' => 'existing@company.com',
        'is_staff' => '0',
    ])->assertRedirect(route('admin.users.edit', $user))
        ->assertSessionHasErrors(['email' => 'Ya existe una cuenta con este correo.']);

    expect($user->refresh()->name)->not->toBe('Changed Name');
    expect($user->email)->toBe('first@company.com');
});

it('rejects an invalid email address', function (): void {
    $staff = User::factory()->staff()->create();
    $user = User::factory()->create(['email' => 'first@company.com']);

    $this->actingAs($staff)->from(route('admin.users.edit', $user))->put(route('admin.users.update', $user), [
        'name' => 'Changed Name',
        'email' => 'not-an-email',
        'is_staff' => '0',
    ])->assertRedirect(route('admin.users.edit', $user))
        ->assertSessionHasErrors(['email' => 'Introduce una dirección de correo válida.']);

    expect($user->refresh()->email)->toBe('first@company.com');
});
