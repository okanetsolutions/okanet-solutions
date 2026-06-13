@extends('layouts.site')

@section('title', $post->title . ' — Blog Okanet')
@section('description', $post->excerpt ?? \Illuminate\Support\Str::limit(strip_tags($post->body), 150))

@section('content')
    <article class="relative pt-36 pb-24 md:pt-44 md:pb-32 bg-paper">
        <div class="absolute inset-0 schematic mask-fade opacity-60 pointer-events-none"></div>

        <div class="relative max-w-3xl mx-auto px-6">
            <div class="flex items-center gap-3 mb-10 font-mono text-xs text-greige">
                <a href="{{ route('blog.index') }}" class="hover:text-espresso transition-colors">← Blog</a>
                <span class="h-px w-8 bg-espresso/20"></span>
                @if ($post->isPublished())
                    <span>{{ $post->published_at->translatedFormat('d M Y') }}</span>
                @else
                    <span class="px-1.5 py-0.5 border border-espresso/25 rounded-sm text-espresso">Borrador</span>
                @endif
                <span class="ml-auto">{{ $post->readingTime() }} min de lectura</span>
            </div>

            <h1 class="font-display font-medium tracking-tight leading-[1.02] text-4xl md:text-5xl lg:text-6xl mb-8">
                {{ $post->title }}
            </h1>

            @if ($post->excerpt)
                <p class="text-umber text-lg md:text-xl leading-relaxed mb-12 pt-6 border-t border-espresso/15">
                    {{ $post->excerpt }}
                </p>
            @endif

            <div class="article-body">
                {!! \Illuminate\Support\Str::markdown($post->body, ['html_input' => 'strip', 'allow_unsafe_links' => false]) !!}
            </div>

            <div class="mt-16 pt-8 border-t border-espresso/15 flex items-center justify-between">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-3 text-espresso hover:text-terracotta font-medium transition-colors border-b border-espresso/30 hover:border-terracotta pb-1">
                    ← Volver al blog
                </a>
                <span class="font-mono text-xs text-greige">Okanet Solutions · Caracas, VE</span>
            </div>
        </div>
    </article>
@endsection
