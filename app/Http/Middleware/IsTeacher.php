<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->get('user_type') !== 'teacher') {
            return redirect('/login#teacher')->withErrors(['message' => 'Silakan login untuk melanjutkan.']);
        }
        return $next($request);
    }
}
