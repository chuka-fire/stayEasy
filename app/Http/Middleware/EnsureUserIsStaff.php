<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsStaff
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->isStaff()) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')
                ->withErrors(['form.email' => 'This account is no longer active.']);
        }

        return $next($request);
    }
}
