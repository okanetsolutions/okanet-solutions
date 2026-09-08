@extends('layouts.site')

@section('title', 'Blog — Okanet Solutions')
@section('description', 'Artículos sobre software, IA y tecnología desde Caracas, por el equipo de Okanet Solutions.')

@section('content')
    <section class="page-hero site-width">
        <p class="section-label">El blog de Okanet</p>
        <h1>Notas de <span>ingeniería.</span>
        </h1>
        <p class="page-lead">Experiencias y notas del equipo sobre desarrollo de software, automatización y tecnología.</p>
    </section>
    <section class="site-width blog-posts" aria-label="Artículos del blog">
        @if ($posts->isEmpty())
            <div class="blog-empty">
                <h2>Estamos preparando nuestras primeras notas.</h2>
                <p>Pronto compartiremos experiencias del equipo. Mientras tanto, puedes conocer nuestros productos o conversar sobre tu proyecto.</p>
                <a class="text-link" href="{{ route('products') }}">Explorar productos <span aria-hidden="true">↗</span>
                </a>
            </div>
        @else
            <p class="blog-count">{{ $posts->total() }} {{ $posts->total() === 1 ? 'artículo' : 'artículos' }}</p>
            @foreach ($posts as $post)
                <article class="blog-post-row">
                    <div class="blog-post-meta">
                        <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->translatedFormat('d M Y') }}</time>
                        <span>{{ $post->readingTime() }} min de lectura</span>
                    </div>
                    <div>
                        <h2>
                            <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                        </h2>
                        @if ($post->excerpt)
                            <p>{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post) }}" class="text-link" aria-label="{{ 'Leer artículo: '.$post->title }}">Leer artículo <span aria-hidden="true">↗</span>
                        </a>
                    </div>
                </article>
            @endforeach
            @if ($posts->hasPages())
                <div class="mt-12">{{ $posts->links() }}</div>
            @endif
        @endif
    </section>
@endsection
