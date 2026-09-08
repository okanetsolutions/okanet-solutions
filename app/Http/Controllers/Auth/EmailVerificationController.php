<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmailVerificationController extends Controller
{
    public function show(Request $request): View|RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('security.dashboard');
        }

        return view('auth.verify-email');
    }

    public function update(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();

        return redirect()->route('security.dashboard')->with('status', 'Correo verificado. Ya puedes solicitar tu consulta.');
    }

    public function store(Request $request): RedirectResponse
    {
        if (! $request->user()->hasVerifiedEmail()) {
            $request->user()->sendEmailVerificationNotification();
        }

        return back()->with('status', 'Enlace de verificación enviado. Revisa también el correo no deseado.');
    }
}
