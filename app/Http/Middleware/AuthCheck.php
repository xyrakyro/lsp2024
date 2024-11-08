<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->get('user_type') == 'student') {
            return redirect('/student');
        } elseif($request->session()->get('user_type') == 'teacher') {
            return redirect('/teacher');
        }
        return $next($request);
    }
}
