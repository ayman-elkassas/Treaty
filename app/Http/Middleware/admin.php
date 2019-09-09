<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next=null,$guard=null)
    {
//        return dd(Auth::guard($guard)->check());
	    if (Auth::guard($guard)->check()) {
	    	return $next($request);
	    }
	    else
	    {
	    	return redirect('admin/login');
	    }

    }
}
