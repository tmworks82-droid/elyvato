<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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

    /**
     * Customize exception response rendering.
     */
    public function render($request, Throwable $exception)
    {
        // Redirect to not-authorized page for unauthorized/authentication errors
        if ($exception instanceof AuthorizationException || $exception instanceof AuthenticationException) {
            return redirect()->route('not.authorized');
        }

        // Show 404 page for NotFoundHttpException
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // For all other HttpExceptions (like 500, 503, etc.)
        if ($exception instanceof HttpException) {
            return response()->view('errors.generic', ['code' => $exception->getStatusCode()], $exception->getStatusCode());
        }

        // Default fallback
        return parent::render($request, $exception);
    }
}
