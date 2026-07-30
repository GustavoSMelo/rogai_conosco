<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAuthenticate
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->get('dashboard_authenticated', false)) {
            return redirect()->route('painel.login');
        }

        return $next($request);
    }
}
