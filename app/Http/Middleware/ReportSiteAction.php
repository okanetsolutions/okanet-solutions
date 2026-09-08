<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Notifications\SiteActionOccurred;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class ReportSiteAction
{
    /** @var array<string, string> */
    private const ACTION_DESCRIPTIONS = [
        'login.store' => 'Inicio de sesión',
        'logout' => 'Cierre de sesión',
        'password.email' => 'Solicitud de recuperación de contraseña',
        'password.update' => 'Contraseña restablecida',
        'verification.send' => 'Reenvío de verificación de correo',
        'verification.verify' => 'Verificación de correo',
        'security.email.store' => 'Consulta de exposición del correo',
        'security.email.details' => 'Solicitud del informe completo del correo',
        'security.assessments.store' => 'Registro de un dominio para evaluación',
        'security.assessments.verify' => 'Comprobación del dominio por DNS',
        'security.assessments.renew' => 'Renovación del código DNS',
        'security.assessments.authorize' => 'Autorización de una evaluación',
        'security.assessments.download' => 'Descarga de un informe de evaluación',
        'security.assessments.full-report' => 'Solicitud de un informe completo',
        'admin.posts.store' => 'Creación de un artículo',
        'admin.posts.update' => 'Actualización de un artículo',
        'admin.posts.destroy' => 'Eliminación de un artículo',
        'admin.users.update' => 'Actualización de un usuario',
        'admin.assessments.start' => 'Inicio de una evaluación',
        'admin.assessments.upload' => 'Carga de un informe de evaluación',
        'admin.assessments.deliver' => 'Entrega de un informe de evaluación',
        'admin.assessments.download' => 'Descarga administrativa de un informe',
        'admin.assessments.followup' => 'Seguimiento de informe marcado como atendido',
        'admin.email.followup' => 'Seguimiento de correo marcado como atendido',
        'api.auth.token' => 'Inicio de sesión en la API',
        'api.auth.logout' => 'Cierre de sesión en la API',
        'api.posts.store' => 'Creación de un artículo mediante la API',
        'api.posts.update' => 'Actualización de un artículo mediante la API',
        'api.posts.destroy' => 'Eliminación de un artículo mediante la API',
    ];

    /** @var array<int, string> */
    private const REPORTED_READ_ACTIONS = [
        'verification.verify',
        'security.assessments.download',
        'admin.assessments.download',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $actorBeforeAction = $request->user();
        $response = $next($request);

        if (! $this->shouldReport($request, $response)) {
            return $response;
        }

        $recipient = config('services.activity_notifications.recipient');
        $route = $request->route();
        $routeName = $route instanceof Route ? $route->getName() : null;
        $routeUri = $route instanceof Route ? $route->uri() : $request->path();
        $actor = $request->user() ?? $actorBeforeAction;

        Notification::route('mail', $recipient)->notify(new SiteActionOccurred(
            description: self::ACTION_DESCRIPTIONS[$routeName] ?? $this->fallbackDescription($request, $routeUri),
            actorName: $this->actorAttribute($actor, 'name'),
            actorEmail: $this->actorAttribute($actor, 'email'),
            method: $request->method(),
            routeName: $routeName ?? 'sin nombre',
            routeUri: '/'.$routeUri,
            ipAddress: $request->ip(),
            occurredAt: now()->toIso8601String(),
        ));

        return $response;
    }

    private function shouldReport(Request $request, Response $response): bool
    {
        $recipient = config('services.activity_notifications.recipient');
        $route = $request->route();
        $routeName = $route instanceof Route ? $route->getName() : null;

        if (! config('services.activity_notifications.enabled')
            || ! is_string($recipient)
            || blank($recipient)
            || $response->getStatusCode() >= 400
            || $this->hasNewValidationErrors($request)) {
            return false;
        }

        if ($routeName === 'register.store') {
            return false;
        }

        return ! $request->isMethodSafe() || in_array($routeName, self::REPORTED_READ_ACTIONS, true);
    }

    private function hasNewValidationErrors(Request $request): bool
    {
        if (! $request->hasSession()) {
            return false;
        }

        $newFlashData = $request->session()->get('_flash.new', []);

        return is_array($newFlashData) && in_array('errors', $newFlashData, true);
    }

    private function fallbackDescription(Request $request, string $routeUri): string
    {
        return 'Solicitud '.$request->method().' completada en '.$routeUri;
    }

    private function actorAttribute(mixed $actor, string $attribute): ?string
    {
        if (! $actor instanceof User) {
            return null;
        }

        $value = $actor->getAttribute($attribute);

        return is_string($value) ? $value : null;
    }
}
