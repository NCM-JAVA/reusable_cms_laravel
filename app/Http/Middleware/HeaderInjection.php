<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HeaderInjection
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // // Define the allowed domain
        // $allowedDomain = '125.20.102.85';

        // // Get the Host header or Server Name
        // $host = $request->header('Host') ?? $request->server('SERVER_NAME');

        // // Debugging logs to check requests (Optional: Remove in production)
        // \Log::info('Incoming request from: ' . $host);

        // // Block request if the domain does not match
        // if ($host !== $allowedDomain) {
        //     return response()->json([
        //         'error' => 'Access Denied: Unauthorized domain.',
        //     ], Response::HTTP_FORBIDDEN);
        // }

        // $allowed_domains = ['125.20.102.85']; // Allowed domains
        // $default_domain  = '125.20.102.85';  // Default fallback domain

        // // Get the current domain from HTTP request headers
        // $current_host = $_SERVER['HTTP_HOST'] ?? '';

        // // Validate against allowed domains
        // if (!in_array($current_host, $allowed_domains, false)) {
        //     header('HTTP/1.1 403 Forbidden');
        //     exit(json_encode(['error' => 'Access Denied: Unauthorized domain.']));
        // }

        // // Check for header injection attempts (prevents Burp Suite tampering)
        // if (preg_match('/[\r\n]/', $current_host)) {
        //     header('HTTP/1.1 403 Forbidden');
        //     exit(json_encode(['error' => 'Access Denied: Suspicious header detected.']));
        // }

        // // Set base URL securely
        // $config['base_url'] = (!empty($_SERVER['HTTPS']) ? 'https://' : 'http://') . $default_domain;

        // $allowed_hosts = ['125.20.102.85']; // Add your allowed hosts here
        // $host = $request->header('Host');
    
        // if (!in_array($host, $allowed_hosts)) {
        //     // If the host is not in the whitelist, redirect to a default or error page
        //     return redirect('error_page');
        // }

        // try {
        //     return $next($request);
        // } catch (HttpException $exception) {
        //     if ($exception->getStatusCode() === 301) {
        //         $redirectUrl = $exception->getHeaders()['Location'] ?? null;

        //         if (!$redirectUrl || $redirectUrl !== 'http://125.20.102.85/dca') {
        //             return response()->view('errors.301', [], 301);
        //         }

        //         return redirect()->to($redirectUrl, 301);
        //     }

        //     throw $exception;
        // }
        

        return $next($request);
    }
}
