<?php

namespace App\Http\Middleware;

use Closure;

class Profile
{
    protected $access = ['Sa'=> 3,'Administrator' => 2,'User' => 1];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next,$profile)
    {
        if($this->access[auth()->user()->Profile] < $this->access[$profile]){
           // abort(401);
            return redirect()->route('catalog.index');
        }
        return $next($request);
    }
}
