<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin — Okanet Solutions')</title>
    <meta name="robots" content="noindex, nofollow">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=fraunces:400,500,600,700|inter:300,400,500,600,700|jetbrains-mono:400,500,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-bone text-espresso antialiased font-sans selection:bg-terracotta selection:text-bone min-h-screen">

    <nav class="bg-espresso text-bone">
        <div class="max-w-5xl mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-terracotta flex items-center justify-center font-display font-bold text-bone text-sm">O</div>
                    <span class="font-display font-semibold tracking-tight">Okanet <span class="font-mono text-xs text-stone font-normal">/ admin</span></span>
                </a>
                <a href="{{ route('admin.posts.index') }}" class="font-mono text-xs uppercase tracking-widest text-stone hover:text-bone transition-colors">Artículos</a>
            </div>
            <div class="flex items-center gap-5">
                <a href="{{ route('blog.index') }}" class="font-mono text-xs text-stone hover:text-bone transition-colors">Ver blog ↗</a>
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
</body>
</html>
