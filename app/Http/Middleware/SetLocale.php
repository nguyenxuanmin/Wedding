<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->has('lang') && in_array($request->lang, ['vi', 'en'])) {
            $lang = $request->lang;
            session(['app_locale' => $lang]);
        }
        $lang = session('app_locale', 'vi');
        App::setLocale($lang);
        View::share('lang', $lang);
        return $next($request);
    }
}
