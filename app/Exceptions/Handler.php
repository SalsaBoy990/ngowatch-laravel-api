<?php

namespace App\Exceptions;

use App\Http\Traits\Helpers\ApiResponseTrait;

//use Sentry\Laravel\Integration;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseTrait;

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
        // https://docs.sentry.io/platforms/php/guides/laravel/
        $this->reportable(function (Throwable $e) {
            if (app()->bound('sentry')) {
                app('sentry')->captureException($e);
            }
//            Integration::captureUnhandledException($e);
        });
    }

    /**
     * Report or log an exception.
     *
     * @param  Throwable  $exception
     *
     * @return void
     *
     * @throws Exception|Throwable
     */
    public function report(Throwable $exception): void
    {
        $ignoreable_exception_messages = ['Unauthenticated or Token Expired, Please Login'];
//        $ignoreable_exception_messages[] = 'The refresh token is invalid.';
        $ignoreable_exception_messages[] = 'The resource owner or authorization server denied the request.';
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            if (!in_array($exception->getMessage(), $ignoreable_exception_messages)) {
                app('sentry')->captureException($exception);
            }
        }

        parent::report($exception);
    }


    public function render($request, Exception|Throwable $exception)
    {
        // For every http 404 errors (web routes), redirect to the home page where the Vue app resides!
        if ($exception instanceof NotFoundHttpException) {
//           return redirect()->guest('/');
        }

        // This is the error handling for the api routes
        if ($request->expectsJson()) {
            if ($exception instanceof PostTooLargeException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => "Size of attached file should be less ".ini_get("upload_max_filesize")."B",
                    ],
                    400
                );
            }

            if ($exception instanceof AuthorizationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Forbidden',
                    ],
                    403
                );
            }

            if ($exception instanceof AuthenticationException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Unauthenticated or Token Expired, Please Login',
                    ],
                    401
                );
            }
            if ($exception instanceof ThrottleRequestsException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Too Many Requests,Please Slow Down',
                    ],
                    429
                );
            }
            if ($exception instanceof ModelNotFoundException) {
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'Entry for '.str_replace('App\\', '', $exception->getModel()).' not found',
                    ],
                    404
                );


            }
            if ($exception instanceof ValidationException) {

                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => $exception->getMessage(),
                        'errors' => $exception->errors(),
                    ],
                    422
                );
            }
            if ($exception instanceof QueryException) {

                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => 'There was Issue with the Query',
                        'exception' => $exception,

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
            //             'exception'  => $exception
            //         ],
            //         500
            //     );
            // }
            if ($exception instanceof \Error) {
                // $exception = $exception->getResponse();
                return $this->apiResponse(
                    [
                        'success' => false,
                        'message' => "There was some internal error",
                        'exception' => $exception,
                    ],
                    500
                );
            }
        }

        return parent::render($request, $exception);

    }
}
