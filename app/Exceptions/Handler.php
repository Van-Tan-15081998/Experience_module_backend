<?php

namespace App\Exceptions;

use App\Lib\Business\Common\Exception\TestException;
use App\Lib\Business\Constants\DreamerCommonErrorCode;
use App\Lib\WebCommon\Helpers\ResponseHelper;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

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
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if($request->is('api') || $request->is('api/*')) {

            if ($exception instanceof AuthenticationException) {
                return $this->handleAuthenticationException($request, $exception);
            }
            if($exception instanceof ValidationException) {
                return $this->handleValidationException($request, $exception);
            }
        }

        return parent::render($request, $exception);
    }

    private function handleAuthenticationException($request, AuthenticationException $exception)
    {
        return ResponseHelper::responseOnError(401,
            DreamerCommonErrorCode::E00900000001()->getCode(),
            DreamerCommonErrorCode::E00900000001()->getDescription()
        );
    }

    private function handleValidationException($request, ValidationException $exception): Response
    {
        return ResponseHelper::responseOnValidationErrorsFromException($exception);
    }
}
