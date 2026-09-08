<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $users = User::query()
            ->when($search !== '', function (Builder $query) use ($search): void {
                $query->where(function (Builder $query) use ($search): void {
                    $query->where('name', 'like', '%'.$search.'%')
                        ->orWhere('email', 'like', '%'.$search.'%');
                });
            })
            ->orderByDesc('is_staff')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        if (is_string($request->input('email'))) {
            $request->merge(['email' => mb_strtolower(trim($request->input('email')))]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:rfc', 'max:255', Rule::unique('users')->ignore($user)],
            'is_staff' => ['required', 'boolean'],
        ], [
            'email.email' => 'Introduce una dirección de correo válida.',
            'email.unique' => 'Ya existe una cuenta con este correo.',
        ]);

        if ($request->user()->is($user) && ! $request->boolean('is_staff')) {
            throw ValidationException::withMessages([
                'is_staff' => 'No puedes retirar tu propio acceso de administrador.',
            ]);
        }

        $emailChanged = $user->email !== $data['email'];

        $user->forceFill([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_staff' => $request->boolean('is_staff'),
            'email_verified_at' => $emailChanged ? null : $user->email_verified_at,
        ])->save();

        return redirect()->route('admin.users.edit', $user)->with('status', 'Usuario actualizado.');
    }
}
