<?php

namespace App\Http\Middleware;

use Closure;
use Request;
use DB;

class CheckEnvironmentMode
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
        $maintenance = DB::table('environment_mode')
                        ->where('state_name', 'MAINTENANCE')
                        ->where('status', 1)
                        ->get()
                        ->first();

        $current_uri = Request::url();
        $lala = strpos($current_uri, 'maintenance');

                        
        if(!empty($maintenance) && (strpos($current_uri, 'maintenance') === false))
        {
            return redirect('/maintenance');
        }else if(empty($maintenance) && (strpos($current_uri, 'maintenance')))
        {
            return redirect('/');
        }
        

        return $next($request);
    }
}
