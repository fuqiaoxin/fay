<?php

namespace App\Helpers;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ApiExceptionReport
{
    use ApiResponse;

    /**
     * @var Exception
     */
    public $exception;
    /**
     * @var Request
     */
    public $request;

    /**
     * @var
     */
    protected $report;

    /**
     * ExceptionReport constructor.
     * @param Request $request
     * @param Exception $exception
     */
    function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    /**
     * @var array
     */
    public $doReport = [
        AuthenticationException::class => ['Authorization failed',401],
        ModelNotFoundException::class => ['该模型未找到',404],
        ValidationException::class => [],   // 请求参数基本验证错误类
        ThrottleRequestsException::class => ['Too Many Attempts', 429],
    ];

    /**
     * @return bool
     */
    public function shouldReturn(){

//        if (! ($this->request->wantsJson() || $this->request->ajax())){
//            return false;
//        }

        foreach (array_keys($this->doReport) as $report){

            if ($this->exception instanceof $report){

                $this->report = $report;
                return true;
            }
        }

        return false;

    }

    /**
     * @param Exception $e
     * @return static
     */
    public static function make(Exception $e){

        return new static(\request(),$e);
    }

    /**
     * @return mixed
     */
    public function report(){

        if ($this->exception instanceof ValidationException) {
            $message = $this->exception->errors();
            return $this->failed($message);
        }

        $message = $this->doReport[$this->report];
        return $this->failed($message[0],$message[1]);

    }

}