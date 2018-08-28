<?php

namespace App\Exceptions;

use App\Helpers\ApiExceptionReport;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // 当请求api接口时 将方法拦截到自己的 ApiExceptionReport
        //dd(env('API_DOMAIN'));

        $requestHost = $request->getHost();

        //dd($requestHost == env('API_DOMAIN'));
        //dd($requestHost == config('app.api_domain'));
        if ($requestHost == config('app.api_domain')) {
            $reportor = ApiExceptionReport::make($exception);
            if ($reportor->shouldReturn()) {
                return $reportor->report();
            }
        }

        return parent::render($request, $exception);
    }
}
