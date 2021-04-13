<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Session\Session;

class Language
{
    public function handle($request, Closure $next)
    {
        if (\Session::has('language')) {
            app()->setLocale(\Session::get('language'));
        }

        return $next($request);
    }
}
