@extends('layouts.admin')

@section('title', 'Usuarios — Admin')

@section('content')
    <div class="flex flex-col gap-8 mb-10 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="font-display font-medium tracking-tight text-3xl">Usuarios</h1>
            <p class="mt-2 text-sm text-umber">
                {{ $users->total() }} {{ $users->total() === 1 ? 'resultado' : 'resultados' }}
                @if ($search !== '')
                    para «{{ $search }}» · <a href="{{ route('admin.users.index') }}" class="font-medium text-terracotta hover:text-espresso" wire:navigate>Limpiar búsqueda</a>
                @else
                    en el panel
                @endif
            </p>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}" class="flex w-full gap-2 sm:max-w-md" role="search">
            <label for="user-search" class="sr-only">Buscar por nombre o correo</label>
            <input id="user-search" name="search" type="search" value="{{ $search }}" placeholder="Nombre o correo"
                class="min-w-0 flex-1 border border-espresso/25 bg-paper px-4 py-2.5 text-sm text-espresso placeholder:text-umber focus:border-terracotta focus:outline-none">
            <button type="submit" class="pressable bg-espresso px-5 py-2.5 text-sm font-medium text-bone hover:bg-terracotta">Buscar</button>
        </form>
    </div>

    @if ($users->isEmpty())
        <div class="border border-espresso/15 bg-paper p-12 text-center">
            <p class="font-medium">No encontramos usuarios.</p>
            <p class="mt-2 text-sm text-umber">Prueba con otro nombre o correo.</p>
            <a href="{{ route('admin.users.index') }}" class="mt-5 inline-block text-sm font-medium text-terracotta hover:text-espresso" wire:navigate>Limpiar búsqueda</a>
        </div>
    @else
        <div class="overflow-x-auto border border-espresso/15 bg-paper">
            <table class="w-full min-w-3xl border-collapse text-left">
                <thead class="border-b border-espresso/15 bg-mist">
                    <tr class="font-mono text-[11px] uppercase tracking-wider text-umber">
                        <th scope="col" class="px-5 py-3 font-medium">Usuario</th>
                        <th scope="col" class="px-5 py-3 font-medium">Correo</th>
                        <th scope="col" class="px-5 py-3 font-medium">Acceso</th>
                        <th scope="col" class="px-5 py-3 font-medium">Registro</th>
                        <th scope="col" class="px-5 py-3 text-right font-medium"><span class="sr-only">Acciones</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-espresso/10">
                    @foreach ($users as $user)
                        <tr class="transition-colors hover:bg-mist/70">
                            <th scope="row" class="px-5 py-4 font-medium text-espresso">
                                {{ $user->name }}
                                @if (auth()->user()->is($user))
                                    <span class="ml-2 font-mono text-[10px] uppercase tracking-wide text-terracotta">Tú</span>
                                @endif
                            </th>
                            <td class="px-5 py-4 text-sm text-umber">
                                {{ $user->email }}
                                <span class="mt-1 block text-xs {{ $user->email_verified_at ? 'text-emerald-deep' : 'text-ochre' }}">
                                    {{ $user->email_verified_at ? 'Verificado' : 'Pendiente de verificar' }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex border px-2.5 py-1 font-mono text-[10px] uppercase tracking-wide {{ $user->is_staff ? 'border-terracotta/30 bg-terracotta/10 text-terracotta-dark' : 'border-espresso/15 text-umber' }}">
                                    {{ $user->is_staff ? 'Administrador' : 'Cliente' }}
                                </span>
                            </td>
                            <td class="px-5 py-4 font-mono text-xs tabular text-umber">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.users.edit', $user) }}" class="text-sm font-medium text-terracotta hover:text-espresso" wire:navigate>Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">{{ $users->links() }}</div>
    @endif
@endsection
