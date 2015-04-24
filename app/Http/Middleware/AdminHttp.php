<?php namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminHttp {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if(!Auth::checkAdmin()) {
            return redirect('/');
        }

		return $next($request);
	}

}
