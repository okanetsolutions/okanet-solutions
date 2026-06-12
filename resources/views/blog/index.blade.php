@extends('layouts.site')

@section('title', 'Blog — Okanet Solutions')
@section('description', 'Artículos sobre software, IA y tecnología desde Caracas, por el equipo de Okanet Solutions.')

@section('content')
    <section class="relative pt-36 pb-16 md:pt-44 md:pb-20 overflow-hidden">
        <div class="absolute inset-0 grain opacity-50 pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-12 font-mono text-xs text-greige uppercase tracking-widest">
                <span>(B)</span>
                <span class="h-px w-12 bg-espresso/30"></span>
                <span>Blog</span>
                <span class="ml-auto hidden sm:block">{{ $posts->total() }} {{ $posts->total() === 1 ? 'artículo' : 'artículos' }}</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 items-end" data-reveal-group>
                <div class="lg:col-span-8" data-reveal>
                    <h1 class="font-display font-medium tracking-tight leading-[0.95] text-[clamp(3rem,7vw,6rem)]">
                        Notas de<br>
                        <span class="italic font-light text-terracotta">ingeniería.</span>
                    </h1>
                </div>
                <div class="lg:col-span-4 lg:pb-4" data-reveal>
                    <div class="h-px w-16 bg-espresso/40 mb-5"></div>
                    <p class="text-umber leading-relaxed">
                        Lo que aprendemos construyendo software vertical con IA, contado sin marketing.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-24 md:pb-32">
        <div class="max-w-7xl mx-auto px-6">
            @if ($posts->isEmpty())
                <div class="border border-espresso/15 bg-paper p-16 text-center">
                    <p class="font-mono text-xs text-greige uppercase tracking-widest mb-3">// sin artículos aún</p>
                    <p class="text-umber">Pronto publicaremos el primero.</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-px bg-espresso/15 border border-espresso/15" data-reveal-group>
                    @foreach ($posts as $post)
                        <a href="{{ route('blog.show', $post) }}" class="group pressable bg-paper hover:bg-cream p-10 flex flex-col" data-reveal>
                            <div class="flex items-center justify-between font-mono text-xs text-greige mb-10">
                                <span>{{ $post->published_at->translatedFormat('d M Y') }}</span>
                                <span>{{ $post->readingTime() }} min</span>
                            </div>
                            <h2 class="font-display text-2xl md:text-3xl font-medium tracking-tight leading-tight mb-4 group-hover:text-terracotta transition-colors">
                                {{ $post->title }}
                            </h2>
                            @if ($post->excerpt)
                                <p class="text-umber text-sm leading-relaxed mb-8 line-clamp-3">{{ $post->excerpt }}</p>
                            @endif
                            <div class="mt-auto flex items-center gap-2 text-terracotta font-medium text-sm">
                                Leer artículo
                                <span class="font-mono group-hover:translate-x-1 transition-transform">→</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <div class="mt-12">
                        {{ $posts->links() }}
                    </div>
                @endif
            @endif
        </div>
    </section>
@endsection
