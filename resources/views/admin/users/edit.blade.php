@extends('layouts.admin')

@section('title', 'Editar usuario — Admin')

@section('content')
    <div class="mx-auto max-w-2xl">
        <a href="{{ route('admin.users.index') }}" class="font-mono text-xs text-greige transition-colors hover:text-espresso" wire:navigate>← Volver a usuarios</a>

        <div class="mt-8 border-b border-espresso/15 pb-6">
            <h1 class="font-display text-3xl font-medium tracking-tight">Editar usuario</h1>
            <p class="mt-2 text-sm text-umber">Creado el {{ $user->created_at->format('d/m/Y') }} · {{ $user->email_verified_at ? 'Correo verificado' : 'Correo pendiente de verificar' }}</p>
        </div>

        @if ($errors->any())
            <div class="mt-6 border border-terracotta/40 bg-terracotta/10 px-5 py-4 text-sm text-terracotta-dark" role="alert">
                <p class="font-medium">Revisa la información indicada.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-8 space-y-7">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-2 block text-sm font-medium">Nombre</label>
                <input id="name" name="name" value="{{ old('name', $user->name) }}" required maxlength="255" autocomplete="name" autofocus
                    class="w-full border border-espresso/25 bg-paper px-4 py-3 text-espresso focus:border-terracotta focus:outline-none">
            </div>

            <div>
                <label for="email" class="mb-2 block text-sm font-medium">Correo</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required maxlength="255" autocomplete="email" aria-describedby="email-help"
                    class="w-full border border-espresso/25 bg-paper px-4 py-3 text-espresso focus:border-terracotta focus:outline-none">
                <p id="email-help" class="mt-2 text-sm leading-relaxed text-umber">Si cambias el correo, la cuenta deberá verificar la nueva dirección antes de usar las herramientas de seguridad.</p>
            </div>

            <fieldset class="border border-espresso/15 bg-mist px-5 py-4">
                <legend class="px-2 text-sm font-medium">Nivel de acceso</legend>
                @if (auth()->user()->is($user))
                    <input type="hidden" name="is_staff" value="1">
                    <p class="text-sm leading-relaxed text-umber">Tu cuenta conserva acceso de administrador para evitar que te bloquees fuera del panel.</p>
                @else
                    <input type="hidden" name="is_staff" value="0">
                    <label class="flex cursor-pointer items-start gap-3">
                        <input type="checkbox" name="is_staff" value="1" @checked(old('is_staff', $user->is_staff)) class="mt-0.5 size-4 shrink-0 accent-terracotta">
                        <span>
                            <strong class="block text-sm font-medium">Administrador</strong>
                            <span class="mt-1 block text-sm leading-relaxed text-umber">Puede gestionar usuarios, artículos y solicitudes de seguridad.</span>
                        </span>
                    </label>
                @endif
            </fieldset>

            <div class="flex flex-wrap items-center gap-5 border-t border-espresso/15 pt-7">
                <button type="submit" class="pressable bg-espresso px-7 py-3 font-medium text-bone hover:bg-terracotta">Guardar cambios</button>
                <a href="{{ route('admin.users.index') }}" class="text-sm text-greige transition-colors hover:text-espresso" wire:navigate>Cancelar</a>
            </div>
        </form>
    </div>
@endsection
