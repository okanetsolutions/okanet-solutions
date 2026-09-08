@extends('layouts.account')
@section('title', 'Recupera tu acceso — Okanet Solutions')
@section('account-content')
    <div class="account-narrow">
        <h1>Recupera tu acceso.</h1>
        <p>Te enviaremos un enlace para elegir una nueva contraseña.</p>
        <form method="post" action="{{ route('password.email') }}" class="account-form">
            @csrf
            <div><label for="email">Correo electrónico</label><input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" required autofocus></div>
            <button class="button" type="submit">Enviar enlace</button>
        </form>
        <a class="text-link" href="{{ route('login') }}" wire:navigate>Volver a iniciar sesión</a>
    </div>
@endsection
