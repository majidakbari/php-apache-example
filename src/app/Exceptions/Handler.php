<?php

namespace App\Exceptions;

use App\Exceptions\HttpException\HttpException;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Symfony\Component\HttpKernel\Exception\HttpException as SymfonyHttpException;

/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    protected $appExceptions = [
        NotFoundHttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        HttpResponseException::class,
        MethodNotAllowedHttpException::class,
        AuthenticationException::class,
        UnauthorizedException::class,
        SymfonyHttpException::class,
        ThrottleRequestsException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof HttpException) {

            return $this->generateJsonResponseForHttpExceptions($exception);
        }

        if (in_array(get_class($exception), $this->appExceptions)) {
            return $this->generateJsonResponseForAppExceptions($exception);
        }

        return parent::render($request, $exception);
    }

    /**
     * @param HttpException $e
     * @return \Illuminate\Http\Response
     */
    public function generateJsonResponseForHttpExceptions(HttpException $e)
    {
        return response()->json([
            'code' => $e->getCode(),
            'logRef' => $e->getLogRef(),
            'errorCode' => $e->getErrorCode(),
            'message' => $e->getMessage()
        ], $e->getCode());
    }

    /**
     * @param $e
     * @return \Illuminate\Http\Response
     */
    public function generateJsonResponseForAppExceptions(\Exception $e)
    {
        $class = get_class($e);

        switch ($class) {
            case NotFoundHttpException::class:
                $data = [
                    'code' => 404,
                    'logRef' => 2000,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.' . get_class_name($e))
                ];
                break;
            case ValidationException::class:
                $data = [
                    'code' => 422,
                    'logRef' => 2001,
                    'errorCode' => get_class_name($e),
                    'message' => $e->validator->errors()
                ];
                break;
            case HttpResponseException::class:
                $data = [
                    'code' => 500,
                    'logRef' => 2002,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.' . get_class_name($e))
                ];
                break;
            case MethodNotAllowedHttpException::class:
                $data = [
                    'code' => 405,
                    'logRef' => 2003,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.' . get_class_name($e))
                ];
                break;
            case AuthenticationException::class:
                $data = [
                    'code' => 401,
                    'logRef' => 2004,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.' . get_class_name($e))
                ];
                break;
            case UnauthorizedException::class:
                $data = [
                    'code' => 403,
                    'logRef' => 2005,
                    'errorCode' => get_class_name($e),
                    'message' => ($e->getMessage()) ?? trans('app.' . get_class_name($e))
                ];
                break;
            case ModelNotFoundException::class:
                $data = [
                    'code' => 404,
                    'logRef' => 2006,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.' . get_class_name($e))
                ];
                break;
            case ThrottleRequestsException::class:
                $data = [
                    'code' => 429,
                    'logRef' => 2007,
                    'errorCode' => get_class_name($e),
                    'message' => trans('app.too_many_attempts')
                ];

                break;
            default:
                $data = [
                    'code' => 500,
                    'logRef' => 3000,
                    'errorCode' => get_class_name($e),
                    'message' => 'Error'
                ];

        }

        return response()->json($data, $data['code']);
    }
}
