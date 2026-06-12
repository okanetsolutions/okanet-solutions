@extends('layouts.admin')

@section('title', 'Editar artículo — Admin')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <h1 class="font-display font-medium tracking-tight text-3xl">Editar artículo</h1>
        <a href="{{ route('blog.show', $post) }}" target="_blank" class="font-mono text-xs text-greige hover:text-espresso transition-colors">Ver en el blog ↗</a>
    </div>

    <form method="POST" action="{{ route('admin.posts.update', $post) }}">
        @method('PUT')
        @include('admin.posts._form', ['submitLabel' => 'Actualizar artículo'])
    </form>
@endsection
