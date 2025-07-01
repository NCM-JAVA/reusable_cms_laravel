<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PreventMultipleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::user());
        // $user = Auth::user();
        // $user->update(['flag_id' => 0]);
        // Auth::logout();
        // dd(Auth::user());
        // dd(Session::all());

        // dd(Auth::user());
        // dd("Hello");
        // Session::flush();
        
        // if (Auth::check()) {
        //     $user = Auth::user(); 
        //     if (Session::has('admin_login')) {
        //         Auth::logout();
        //         Session::forget('admin_login');
        //         // Session::flush();
        //         return redirect()->route('login')->with('error', 'You are already logged in on another device.');
        //     }
        //     Session::put('admin_login', 1);
        // }
        
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if (Session::has('user_id')) {
        //         if (Session::get('user_id') !== $user->id) {
        //             Auth::logout();
        //             Session::forget('user_id');
        //             return redirect()->route('login')->with('error', 'You are already logged in on another device.');
        //         }
        //     }

        //     Session::put('user_id', $user->id);
        // }

        // dd(Auth::check());
        // if (Auth::check()) {
        //     $user = Auth::user();
        //     if ($user->flag_id == 1) {
        //         Auth::logout();
        //         return redirect()->route('login')->with('error', 'You are already logged in on another device.');
        //     }
        //     $user->update(['flag_id' => 1]);
        // }

        return $next($request);
    }
}
