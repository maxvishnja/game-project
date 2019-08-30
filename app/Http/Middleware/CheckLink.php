<?php

namespace App\Http\Middleware;

use App\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLink
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

        $link = $request->route()->parameter('link');

        if($request->user()){
            if($request->user()->link != $link){
                return redirect('/');
            }
        } else{
            $user = User::where('link', $link)->first();
            if(!$user or empty($user->link_expired) or (Carbon::parse($user->link_expired) < Carbon::now()->today())){

                return redirect('/');
            }

            Auth::guard()->login($user);
        }

        $response = $next($request);

        return $response;
    }
}
