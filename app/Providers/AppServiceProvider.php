<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('staff', fn (User $user): bool => $user->is_staff);

        RateLimiter::for('breachsense', fn (): Limit => Limit::perSecond(1)->by('breachsense-license'));
        RateLimiter::for('registration', fn (Request $request): Limit => Limit::perHour(5)->by($request->ip()));

        VerifyEmail::toMailUsing(fn (object $notifiable, string $url): MailMessage => (new MailMessage)
            ->subject('Verifica tu correo — Okanet Solutions')
            ->greeting('Verifica tu correo corporativo')
            ->line('Confirma tu dirección antes de consultar filtraciones o solicitar una evaluación.')
            ->action('Verificar correo', $url)
            ->line('El enlace vence en 60 minutos. Si no creaste esta cuenta, ignora este mensaje.'));

        ResetPassword::toMailUsing(fn (object $notifiable, string $token): MailMessage => (new MailMessage)
            ->subject('Restablece tu contraseña — Okanet Solutions')
            ->greeting('Recupera tu acceso')
            ->action('Restablecer contraseña', route('password.reset', ['token' => $token, 'email' => $notifiable->getEmailForPasswordReset()]))
            ->line('Si no solicitaste este cambio, ignora este mensaje.'));
    }
}
