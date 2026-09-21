<?php

use App\Http\Middleware\ReportSiteAction;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Behind a TLS-terminating proxy (Cloudflare tunnel) the app sees plain
        // http; trusting the forwarded proto/port keeps generated URLs on https.
        // Only those headers are trusted, so client IPs cannot be spoofed.
        $middleware->trustProxies(at: '*', headers: Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_PORT);

        $middleware->redirectUsersTo(fn () => route('security.dashboard'));
        $middleware->authenticateSessions();
        $middleware->web(append: [ReportSiteAction::class]);
        $middleware->api(append: [ReportSiteAction::class]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        Integration::handles($exceptions);
    })->create();
