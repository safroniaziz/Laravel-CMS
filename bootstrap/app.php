<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'permission' => \App\Http\Middleware\CheckPermission::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Handle CSRF token mismatch gracefully
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            // If it's a login attempt, redirect to fresh login page
            if ($request->is('login')) {
                return redirect()->route('login')
                    ->with('error', 'Your session has expired. Please try logging in again.')
                    ->withInput($request->except('password', '_token'));
            }
            
            // For other routes, redirect to login
            return redirect()->route('login')
                ->with('error', 'Your session has expired. Please log in.');
        });
    })->create();
