<?php

namespace App\Http\Middleware;

use Closure;

class checkuser
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
        
        if($request->session()->get('data')===null){
            return redirect('/');
        }elseif($request->session()->get('data')!==null){
            //return redirect('/admin');
        }
        return $next($request);
    }
}
