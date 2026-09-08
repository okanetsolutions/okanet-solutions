@extends('layouts.site')
@section('robots')<meta name="robots" content="noindex, nofollow">@endsection
@section('content')
    <section class="site-width security-account @yield('account-class')">
        @auth
            <nav class="account-nav" aria-label="Navegación de cuenta">
                <a href="{{ route('security.dashboard') }}" wire:navigate>Mi seguridad</a>
                @can('staff')
                    <a href="{{ route('admin.assessments.index') }}" wire:navigate>Evaluaciones y solicitudes</a>
                    <a href="{{ route('admin.users.index') }}" wire:navigate>Usuarios</a>
                    <a href="{{ route('admin.posts.index') }}" wire:navigate>Blog</a>
                @endcan
                <form method="post" action="{{ route('logout') }}">@csrf<button class="text-link" type="submit">Cerrar sesión</button></form>
            </nav>
        @endauth
        @if(session('status'))
            <p class="account-notice" role="status">{{ session('status') }}</p>
        @endif
        @if($errors->any())
            <div class="account-notice account-error" role="alert" tabindex="-1">
                <p>Revisa lo siguiente:</p>
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif
        @yield('account-content')
    </section>
@endsection
