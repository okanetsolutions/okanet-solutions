@extends('layouts.account')
@section('title', 'Verifica tu correo — Okanet Solutions')
@section('account-content')
    <div class="account-narrow">
        <h1>Revisa tu correo.</h1>
        <p>Enviamos un enlace de verificación a <strong>{{ auth()->user()->email }}</strong>. Ábrelo para activar tu acceso a las consultas y evaluaciones.</p>
        <p>No realizaremos ninguna consulta hasta que hayas verificado tu correo. El enlace vence en 60 minutos.</p>
        <form method="post" action="{{ route('verification.send') }}" class="account-form">@csrf<button class="button" type="submit">Reenviar enlace de verificación</button></form>
        <p class="account-help">Revisa también la carpeta de correo no deseado. Si escribiste mal la dirección, cierra sesión y regístrate con la correcta.</p>
    </div>
@endsection
