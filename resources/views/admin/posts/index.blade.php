@extends('layouts.admin')

@section('title', 'Artículos — Admin')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <h1 class="font-display font-medium tracking-tight text-3xl">Artículos</h1>
        <a href="{{ route('admin.posts.create') }}" class="group inline-flex items-center gap-3 px-6 py-2.5 bg-espresso hover:bg-terracotta text-bone font-medium text-sm transition-colors">
            Nuevo artículo
            <span class="font-mono text-xs group-hover:translate-x-1 transition-transform">→</span>
        </a>
    </div>

    @if ($posts->isEmpty())
        <div class="border border-espresso/15 bg-paper p-16 text-center">
            <p class="font-mono text-xs text-greige uppercase tracking-widest mb-3">// vacío</p>
            <p class="text-umber">Aún no has escrito ningún artículo.</p>
        </div>
    @else
        <div class="border border-espresso/15 divide-y divide-espresso/10 bg-paper">
            @foreach ($posts as $post)
                <div class="px-6 py-5 flex items-center gap-6">
                    <div class="flex-1 min-w-0">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="font-display text-lg font-medium hover:text-terracotta transition-colors block truncate">
                            {{ $post->title }}
                        </a>
                        <div class="font-mono text-xs text-greige mt-1">
                            /blog/{{ $post->slug }} · actualizado {{ $post->updated_at->diffForHumans() }}
                        </div>
                    </div>
                    @if ($post->isPublished())
                        <span class="font-mono text-[10px] px-2 py-1 bg-emerald-deep/15 text-emerald-deep shrink-0">PUBLICADO · {{ $post->published_at->format('d/m/Y') }}</span>
                    @else
                        <span class="font-mono text-[10px] px-2 py-1 bg-ochre/15 text-ochre shrink-0">BORRADOR</span>
                    @endif
                    <div class="flex items-center gap-4 shrink-0 font-mono text-xs">
                        <a href="{{ route('blog.show', $post) }}" target="_blank" class="text-greige hover:text-espresso transition-colors">Ver</a>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="text-greige hover:text-espresso transition-colors">Editar</a>
                        <form method="POST" action="{{ route('admin.posts.destroy', $post) }}" onsubmit="return confirm('¿Eliminar «{{ $post->title }}»? Esta acción no se puede deshacer.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-greige hover:text-terracotta transition-colors">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($posts->hasPages())
            <div class="mt-8">{{ $posts->links() }}</div>
        @endif
    @endif
@endsection
