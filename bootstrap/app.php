<?php

use App\Http\Middleware\AuthCheck;
use App\Http\Middleware\IsStudent;
use App\Http\Middleware\IsTeacher;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo('/login');
        $middleware->alias([
            'auth.check' => AuthCheck::class,
            'teacher.check' => IsTeacher::class,
            'student.check' => IsStudent::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
