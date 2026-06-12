@extends('layouts.site')

@section('title', 'Acceso — Okanet Solutions')

@section('content')
    <section class="relative pt-36 pb-24 md:pt-44 md:pb-32 min-h-screen">
        <div class="absolute inset-0 grain opacity-50 pointer-events-none"></div>

        <div class="relative max-w-md mx-auto px-6">
            <div class="flex items-center gap-3 mb-12 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(A)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Acceso</span>
            </div>

            <h1 class="font-display font-medium tracking-tight text-4xl mb-10">
                Panel de<br><span class="italic text-terracotta">administración.</span>
            </h1>

            <form method="POST" action="{{ route('login') }}" class="border border-espresso/20 bg-paper p-8 space-y-8">
                @csrf
                <div>
                    <label for="email" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors">
                    @error('email')
                        <p class="mt-2 font-mono text-xs text-terracotta">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block font-mono text-xs text-greige uppercase tracking-widest mb-2">— Contraseña</label>
                    <input id="password" type="password" name="password" required
                        class="w-full bg-transparent border-0 border-b border-espresso/30 px-0 py-2 text-espresso placeholder-stone focus:outline-none focus:border-terracotta transition-colors">
                </div>
                <button type="submit" class="group inline-flex items-center gap-3 px-8 py-3.5 bg-espresso hover:bg-terracotta text-bone font-medium transition-colors">
                    Entrar
                    <span class="font-mono text-xs group-hover:translate-x-1 transition-transform">→</span>
                </button>
            </form>
        </div>
    </section>
@endsection
