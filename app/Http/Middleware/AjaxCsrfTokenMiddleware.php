<?php
// app/Http/Middleware/AjaxCsrfTokenMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class AjaxCsrfTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        // Add logic to check if this is an AJAX request
        if ($request->ajax()) {
            // Generate a custom CSRF token for AJAX requests
            $token = csrf_token();

            // Attach the token to the response headers
            return Response::make(['token' => $token])->header('X-CSRF-Token', $token);
        }

        return $next($request);
    }
}
