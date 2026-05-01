<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureQuizRaceUserIsAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! session()->has('quizrace_token') || ! session()->has('quizrace_user')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}