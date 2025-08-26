<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    //  protected function authenticate($request, array $guards)
    //  {
    //      // Check if the admin guard is authenticated
    //      if (Auth::guard('admin')->check()) {
    //          // Set the global guard to 'admin'
    //          Auth::shouldUse('admin');
             
    //          // Ensure the 'auth' instance uses the 'admin' guard
    //          app()->singleton('auth', function () {
    //              return Auth::guard('admin');
    //          });
 
    //          return;  // Proceed if authenticated
    //      }
 
    //      // If not authenticated, trigger the unauthenticated method
    //      $this->unauthenticated($request, ['admin']);
    //  }

       // Ensure the admin guard is checked properly
    // protected function authenticate($request, array $guards)
    // {
    //     if (Auth::guard('admin')->check()) {
    //         Auth::shouldUse('admin'); 
    //         return;
    //     }

    //     $this->unauthenticated($request, ['admin']);
    // }

    // public function handle(Request $request, Closure $next): Response
    // {
    //     if (!Auth::guard('admin')->check()) {
    //         return redirect()->route('admin.login');
    //     }

    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next): Response
    {
        // Set guard to admin
        Auth::shouldUse('admin');
         
        // Check if the admin is authenticated
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Continue to the next request
        $response = $next($request);
      
        // Log only POST, PUT, DELETE requests
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            $buttonName = $request->button ?? 'Unknown Button';

            $eventHistory = match ($request->method()) {
                'POST'   => 'Created',
                'PUT'    => 'Updated',
                'DELETE' => 'Deleted',
                default  => 'Unknown',
            };

            try {
                logEventHistory(
                    $eventHistory,                     // Event Type
                    $buttonName,                       // Event Description (like button pressed)
                    $request->all(),                   // Form Data
                    Auth::guard('admin')->id()         // Admin User ID
                );
            } catch (\Exception $e) {
                \Log::error('LogEventHistory Failed: ' . $e->getMessage());
            }
        }
        return $response;
    }
    

}
