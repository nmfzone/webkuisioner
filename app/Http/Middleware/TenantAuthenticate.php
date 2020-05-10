<?php

namespace App\Http\Middleware;

use Closure;

class TenantAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        return app(Authenticate::class)->handle($request, function ($request) use ($next) {
            /** @var \App\Models\Site|null $site */
            $site = $request->session()->get('site');

            if ($site && ! $site->participants()->find($request->user()->id)) {
                return redirect(route('index'));
            }

            return $next($request);
        });
    }
}
