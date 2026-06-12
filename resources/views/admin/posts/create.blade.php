@extends('layouts.admin')

@section('title', 'Nuevo artículo — Admin')

@section('content')
    <h1 class="font-display font-medium tracking-tight text-3xl mb-10">Nuevo artículo</h1>

    <form method="POST" action="{{ route('admin.posts.store') }}">
        @include('admin.posts._form', ['submitLabel' => 'Guardar artículo'])
    </form>
@endsection
