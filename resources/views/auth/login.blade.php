@extends('layouts.account')
@section('title', 'Inicia sesión — Okanet Solutions')
@section('account-content')
    <div class="account-narrow">
        <h1>Tu cuenta de Okanet.</h1>
        <p>Consulta tus solicitudes, resultados e informes privados.</p>
        <form method="post" action="{{ route('login') }}" class="account-form">
            @csrf
            <div><label for="email">Correo electrónico</label><input id="email" type="email" name="email" autocomplete="email" value="{{ old('email') }}" required autofocus></div>
            <div><label for="password">Contraseña</label><input id="password" type="password" name="password" autocomplete="current-password" required></div>
            <label class="account-check"><input name="remember" type="checkbox" value="1"><span>Mantener mi sesión en este dispositivo</span></label>
            <button type="submit" class="button">Iniciar sesión</button>
            <a class="text-link" href="{{ route('password.request') }}" wire:navigate>Olvidé mi contraseña</a>
        </form>
        <p>¿Primera vez aquí? <a class="text-link" href="{{ route('register') }}" wire:navigate>Crea tu cuenta</a></p>
    </div>
@endsection
