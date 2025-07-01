<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class InactivityTimeout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $timeout = 30;
        // \Log::info('Middleware Running: ' . now());
        // dd("Hello");
        if(Session::has('last_activity')){
            $lastActivity = Session::get('last_activity');
            $timeOutPeriod = now()->diffInMinutes($lastActivity);

            if($timeOutPeriod >= $timeout){
                $user = Auth::user();
                $user->update(['flag_id' => 0]);
                Auth::logout();
                Session::flush();
                return redirect('/admin/login')->with('sessionTimeout', 'Session expired due to inactivity.');
            }
        }

        Session::put('last_activity', now());

        return $next($request);
    }
}
