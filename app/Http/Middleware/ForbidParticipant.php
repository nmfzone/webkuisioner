<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ForbidParticipant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var \App\Models\Site|null $site */
        $site = $request->session()->get('site');

        if (Auth::check() && $site && $site->participants()->find($request->user()->id)) {
            return redirect(route('home'));
        }

        return $next($request);
    }
}
