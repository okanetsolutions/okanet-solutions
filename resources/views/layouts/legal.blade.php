@extends('layouts.site')

@section('content')
    <div class="site-width legal-page">
        <aside>
            <p>Información legal</p>
            <nav aria-label="Documentos legales">
                @foreach (['privacy' => 'Política de privacidad', 'cookies' => 'Política de cookies', 'terms' => 'Términos y condiciones'] as $name => $label)
                    <a href="{{ route($name) }}" wire:navigate @if(request()->routeIs($name)) aria-current="page" @endif>
                        {{ $label }} <span aria-hidden="true">↗</span>
                    </a>
                @endforeach
            </nav>
            <a class="text-link" href="{{ route('contact') }}" wire:navigate>Contactar con Okanet</a>
        </aside>
        <article>
            <h1>@yield('legal-title')</h1>
            <p class="legal-date">Última actualización · 8 de septiembre de 2026</p>
            <div class="article-body">@yield('legal-content')</div>
        </article>
    </div>
@endsection
