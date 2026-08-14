<?php

namespace App\Http\Middleware;

use App\Services\PanelAccessTokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAuthenticate
{
    /**
     * Verify the session carries a valid, unexpired panel access token.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->session()->get('rcapp-token');

        if (blank($token) || ! app(PanelAccessTokenService::class)->validate($token)) {
            $request->session()->forget('rcapp-token');

            return redirect()->route('painel.login');
        }

        return $next($request);
    }
}
