<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user(); //пытаемся получить юзера

        if (!isset($user)) { //если юзера нет - нет логина. редирект на страницу логина
            toastr()->warning('Необходимо войти для просмотра этой страницы.');
            return redirect()->route('login');
        }

        if (!$user->isAdmin()) { //если юзер есть, но он не админ, то редирект на главную с сообщением
            toastr()->error('Доступ запрещен');
            return redirect()->route('home');
        }

        return $next($request);
    }
}
