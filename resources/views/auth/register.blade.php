@extends('layouts.account')
@section('title', 'Crea tu cuenta — Okanet Solutions')
@section('account-content')
    <div class="account-narrow">
        <a class="text-link" href="{{ route('security') }}">← Ciberseguridad</a>
        <h1>Crea tu cuenta.</h1>
        <p>Verifica tu correo corporativo para consultar su exposición o solicitar una evaluación de tu dominio.</p>
        <form method="post" action="{{ route('register') }}" class="account-form">
            @csrf
            <div><label for="name">Nombre completo</label><input id="name" name="name" autocomplete="name" value="{{ old('name') }}" required maxlength="255" autofocus></div>
            <div><label for="email">Correo corporativo</label><input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" required maxlength="255" aria-describedby="email-help"><p id="email-help" class="account-help">Usa el correo de tu empresa. No se admiten proveedores personales ni correos temporales.</p></div>
            <div><label for="password">Contraseña</label><input id="password" name="password" type="password" autocomplete="new-password" required minlength="12" aria-describedby="password-help"><p id="password-help" class="account-help">Al menos 12 caracteres.</p></div>
            <div><label for="password_confirmation">Confirma la contraseña</label><input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required minlength="12"></div>
            <label class="account-check"><input type="checkbox" name="terms" value="1" required @checked(old('terms'))><span>Acepto los <a href="{{ route('terms') }}">términos del servicio</a> y he leído la <a href="{{ route('privacy') }}">política de privacidad</a>.</span></label>
            <button class="button" type="submit">Crear cuenta y verificar correo</button>
        </form>
        <p>¿Ya tienes cuenta? <a class="text-link" href="{{ route('login') }}">Inicia sesión</a></p>
    </div>
@endsection
