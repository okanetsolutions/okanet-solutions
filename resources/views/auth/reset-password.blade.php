@extends('layouts.account')
@section('title', 'Nueva contraseña — Okanet Solutions')
@section('account-content')
    <div class="account-narrow">
        <h1>Elige una contraseña.</h1>
        <form method="post" action="{{ route('password.update') }}" class="account-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div><label for="email">Correo electrónico</label><input id="email" name="email" type="email" autocomplete="email" value="{{ old('email', $email) }}" required></div>
            <div><label for="password">Nueva contraseña</label><input id="password" name="password" type="password" autocomplete="new-password" required minlength="12" aria-describedby="password-help"><p id="password-help" class="account-help">Al menos 12 caracteres.</p></div>
            <div><label for="password_confirmation">Confirma la contraseña</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required minlength="12"></div>
            <button class="button" type="submit">Guardar contraseña</button>
        </form>
    </div>
@endsection
