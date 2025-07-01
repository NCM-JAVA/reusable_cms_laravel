<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Log;
use Throwable;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        
    }

     //Custom error page
     public function render($request, Throwable $exception)
     {

        if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 301) {
                return response()->view('errors.301', [], 301);
            }
        }

        // \Log::error('HTTP Exception Detected first ew');
         if ($exception instanceof NotFoundHttpException) {
             return response()->view('errors.404', [], 404);
         }

         if ($exception instanceof HttpException) {
            if ($exception->getStatusCode() === 403) {
                return response()->view('errors.403', [], 403);
            }
        }

        //  if ($exception instanceof HttpException && $exception->getStatusCode() == 301) {
        //     $redirectUrl = $exception->getHeaders()['Location'] ?? null;
            
        //     if (!$redirectUrl || $redirectUrl !== 'http://125.20.102.85/dca') {
        //         return response()->view('errors.301', [], 400);
        //     }

        //     return redirect()->to($redirectUrl);
        // }

        // if ($exception instanceof HttpException && $exception->getStatusCode() == 301) {
        //     $redirectUrl = $exception->getHeaders()['Location'] ?? null;

        //     if (!$redirectUrl || $redirectUrl !== 'http://125.20.102.85/dca') {
        //         return response()->view('errors.301', [], 400);
        //     }

        //     return redirect()->to($redirectUrl, 301);
        // }
        

        // if ($exception instanceof HttpException) {
        //     \Log::error('HTTP Exception Detected 9998', [
        //         'status_code' => $exception->getStatusCode(),
        //         'headers' => $exception->getHeaders(),
        //     ]);
    
        //     if ($exception->getStatusCode() === 301) {
        //         $redirectUrl = $exception->getHeaders()['Location'] ?? null;
    
        //         if (!$redirectUrl || $redirectUrl !== 'http://125.20.102.85/dca') {
        //             return response()->view('errors.301', [], 301);
        //         }
    
        //         return redirect()->to($redirectUrl, 301);
        //     }
        // }

        
        // $domains = ['125.20.102.85'];
        // \Log::error($domains);
        // if ( ! in_array($_SERVER['SERVER_NAME'], $domains)) {
        //     return response()->view('errors.301', [], 301);
        // }

        // $allowedHosts = ['125.20.102.85'];
        
        // if (!in_array($request->getHost(), $allowedHosts)) {
        //     \Log::error("Hello");
        //     throw new AccessDeniedHttpException('Invalid Host Header');
        // }

        

    //     $allowedHost = '125.20.102.85';
    //     $requestHost = $request->getHost();
    //    // dd($requestHost);
    //     if ($requestHost !== $allowedHost) {
    //         throw new HeaderInjectionException();
    //     }
    //     header_remove("Location");

        // if ($exception->getStatusCode() === 301) {
        //     dd("inside 301");
        //     log::error($exception->getStatusCode());
        //     return response()->view('errors.301', [], 301);
        // }

        // if ($exception instanceof HttpException) {
        //     dd('Exception 301');
        //     if ($exception->getStatusCode() === 301) {
        //         log::error($exception->getStatusCode());
        //         return response()->view('errors.301', [], 301);
        //     }
        // }
 
         return parent::render($request, $exception);
     }
}
