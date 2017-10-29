<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class RoleCheck{
    public function handle($request, Closure $next){

        if(Auth::guard('admin')->check()){
            return $next($request);
        }
        else if(Auth::guard('web')->check()){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
        
    }
}
