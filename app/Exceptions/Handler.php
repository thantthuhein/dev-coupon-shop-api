<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\JsonResponse;

class Handler extends ExceptionHandler
{
    use JsonResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
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

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            if (request()->server('REQUEST_METHOD') == 'GET') {
                return response()->json($this->responseNotFound(), 404);
            }

            if (request()->server('REQUEST_METHOD') == 'POST') {
                return response()->json($this->responseNotFound(), 404);
            }

            if (request()->server('REQUEST_METHOD') == 'PUT') {
                return response()->json($this->responseNotFoundForUpdate(), 404);
            }

            if (request()->server('REQUEST_METHOD') == 'DELETE') {
                return response()->json($this->responseNotFoundForDelete(), 404);
            }
        }
    }
}