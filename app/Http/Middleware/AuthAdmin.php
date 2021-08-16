<?php

namespace App\Http\Middleware;

use App\Providers\AuthServiceProvider;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

// added by Gul
use Illuminate\Support\Facades\Auth;
class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        //Gul
        //Handling the session for user type here
         if(session('utype')==='ADM')
         {
           return $next($request);

         }
         else
         {

        session()->flush();
        return redirect()->route('login');

         }



        return $next($request);
       
          if(Auth::user()->utype ==='ADM'){

            session(['utype'=>'ADM']);
            return redirect(RouteServiceProvider::HOME);

          }
          else{
   
            session(['utype'=>'USR']);
            return redirect(RouteServiceProvider::HOME);

          }



    }
}
