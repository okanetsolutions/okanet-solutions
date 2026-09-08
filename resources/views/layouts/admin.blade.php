<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin — Okanet Solutions')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="16x16 32x32 48x48">
    <link rel="apple-touch-icon" href="{{ asset('images/okanet-icon-180.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-bone text-espresso antialiased font-sans selection:bg-terracotta selection:text-bone min-h-screen">

    <nav class="bg-espresso text-bone">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-wrap items-center justify-between gap-4">
            <div class="flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3" wire:navigate>
                    <img src="{{ asset('images/okanet-logo-light.png') }}" alt="Okanet Solutions" width="534" height="108" class="h-7 w-auto">
                    <span class="font-mono text-xs text-stone">/ admin</span>
                </a>
                <a href="{{ route('admin.assessments.index') }}" wire:navigate @class(['font-mono text-xs uppercase tracking-widest hover:text-bone transition-colors', 'text-bone' => request()->routeIs('admin.assessments.*', 'admin.email.*'), 'text-stone' => ! request()->routeIs('admin.assessments.*', 'admin.email.*')]) @if(request()->routeIs('admin.assessments.*', 'admin.email.*')) aria-current="page" @endif>Solicitudes</a>
                <a href="{{ route('admin.users.index') }}" wire:navigate @class(['font-mono text-xs uppercase tracking-widest hover:text-bone transition-colors', 'text-bone' => request()->routeIs('admin.users.*'), 'text-stone' => ! request()->routeIs('admin.users.*')]) @if(request()->routeIs('admin.users.*')) aria-current="page" @endif>Usuarios</a>
                <a href="{{ route('admin.posts.index') }}" wire:navigate @class(['font-mono text-xs uppercase tracking-widest hover:text-bone transition-colors', 'text-bone' => request()->routeIs('admin.posts.*'), 'text-stone' => ! request()->routeIs('admin.posts.*')]) @if(request()->routeIs('admin.posts.*')) aria-current="page" @endif>Artículos</a>
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route('blog.index') }}" class="font-mono text-xs text-stone hover:text-bone transition-colors" wire:navigate>Ver blog ↗</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="font-mono text-xs text-stone hover:text-terracotta-soft transition-colors">Salir</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-12">
        @if (session('status'))
            <div class="mb-8 border border-emerald-deep/30 bg-emerald-deep/10 text-emerald-deep px-5 py-3 font-mono text-xs">
                {{ session('status') }}
            </div>
        @endif

        @yield('content')
    </main>
    @livewireScripts
</body>
</html>
