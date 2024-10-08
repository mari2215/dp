<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Psr\Log\LogLevel;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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

    // public function render($request, Exception $e)
    // {
    //     if ($e instanceof ModelNotFoundException) {
    //         $e = new NotFoundHttpException($e->getMessage(), $e);
    //     }

    //     if ($e instanceof TokenMismatchException) {
    //         return redirect()->back()->withInput($request->except('password'))->withErrors(['Validation Token was expired. Please try again']);
    //     }

    //     // You can add your own exception here
    //     // so redirect to the home route
    //     if ($e instanceof NotFoundHttpException) {
    //         return redirect()->route('home');
    //     }

    //     return parent::render($request, $e);
    // }
}
