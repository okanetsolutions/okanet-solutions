<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Rules\CorporateEmail;
use App\Services\DnsLookup;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request, DnsLookup $dns): RedirectResponse
    {
        if (is_string($request->input('email'))) {
            $request->merge(['email' => mb_strtolower(trim($request->input('email')))]);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['bail', 'required', 'string', 'email:rfc', 'max:255', 'unique:users,email', new CorporateEmail($dns)],
            'password' => ['required', 'confirmed', Password::min(12)],
            'terms' => ['accepted'],
        ], [
            'email.unique' => 'Ya existe una cuenta con este correo. Inicia sesión o recupera tu contraseña.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'terms.accepted' => 'Acepta las condiciones para crear tu cuenta.',
        ]);

        $user = User::create(collect($data)->only(['name', 'email', 'password'])->all());
        Auth::login($user);
        $request->session()->regenerate();
        event(new Registered($user));

        return redirect()->route('verification.notice');
    }
}
