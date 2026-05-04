<?php

namespace App\Exceptions;

use App\Http\Traits\Helpers\ApiResponseTrait;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use ParseError;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
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
        // $this->reportable(function (Throwable $e) {
        //     //
        // });

        $this->renderable(function(Exception $e, $request) {
            return $this->handleApi($request, $e);
        });
        $this->renderable(function(Throwable $e, $request) {
            return $this->handleApi($request, $e);
        });
    }

    public function handleApi($request,Throwable $exception)
    {
        if ($request->expectsJson()) {
            if ($exception instanceof PostTooLargeException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 400,
                        'message' => "Size of attached file should be less " . ini_get("upload_max_filesize") . "B"
                    ],
                    400
                );
            }

            if ($exception instanceof AuthenticationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 401,
                        'message' => 'Unauthenticated or Token Expired, Please Login'
                    ],
                    401
                );
            }
            if ($exception instanceof ThrottleRequestsException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 429,
                        'message' => 'Too Many Requests,Please Slow Down'
                    ],
                    429
                );
            }
            if ($exception instanceof ModelNotFoundException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 404,
                        'message' => 'Entry for ' . str_replace('App\\', '', $exception->getModel()) . ' not found'
                    ],
                    404
                );
            }

            if ($exception instanceof HttpException) {
                return response()->json(['error'=>$exception->getMessage()], $exception->getStatusCode());
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => $exception->getStatusCode(),
                        'message' => $exception->getMessage(),
                    ],
                    $exception->getStatusCode()
                );
            }

            if($exception instanceof NotFoundHttpException){

                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 400,
                        'message' => 'Something Not found',
                        'exception' => $exception

                    ],
                    400
                );
                
            }

            if($exception instanceof RouteNotFoundException){

                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 400,
                        'message' => 'The Specific URL cannot be found...',
                        'exception' => $exception

                    ],
                    400
                );
                
            }

            if ($exception instanceof ValidationException) {

                foreach (array_reverse($exception->errors()) as $key => $value) {
                    $error=$value;
                }
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 422,
                        'message' => $exception->getMessage(),
                        // 'errors' => $exception->errors(),
                        'errors' => $error
                    ],
                    422
                );
            }
            if ($exception instanceof QueryException) {

                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 500,
                        'message' => 'There was Issue with the Query',
                        'exception' => $exception

                    ],
                    500
                );
            }
            if ($exception instanceof ParseError) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 500,
                        'message' => "Syntax Error",
                        'exception'  => 'Syntax Error'
                    ],
                    500
                );
            }

            // if ($exception instanceof HttpResponseException) {
            //     // $exception = $exception->getResponse();
            //     return $this->apiResponse(
            //         [
            //             'success' => false,
            //             'message' => "There was some internal error",
            //             'exception'  => $exception->getMessage()
            //         ],
            //         500
            //     );
            // }
            if ($exception instanceof \Error || $exception instanceof \ErrorException) {
                // $exception = $exception->getResponse();
                return $this->apiResponse(
                    [
                        'success' => false,
                        'statusCode' => 500,
                        'message' => "There was some internal error",
                        'exception' => $exception->getMessage()
                    ],
                    500
                );
            }

            
            return $this->apiResponse(
                [
                    'success' => false,
                    'statusCode' => 500,
                    'message' => "Unexpected Exception",
                    'exception' => $exception
                ],
                500
            );
        }
    }
}
