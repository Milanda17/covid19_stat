<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $response_status_code = API_RES_STATUS_SUCCESS;
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $exception)
    {
        $message = null;
        if ($exception->getMessage() == 'You are not authorized to access this resource.') {
            $message =  'You are not authorized to access this resource.';
            $this->response_status_code = API_RES_STATUS_UNAUTHORIZED;
        }

        if ($exception instanceof ValidationException)
        {
            $response['errors']['validations'] = $exception->errors();
            return response(['data'=>$response])->header('Content-Type', 'application/json');
        }

        if ($exception instanceof AuthenticationException)
        {
            return response(['error'=>$exception->getMessage()],$this->response_status_code)->header('Content-Type', 'application/json');
        }
        if($message == null){
            dd($exception);
            return response(['error'=>$exception],$this->response_status_code)->header('Content-Type', 'application/json');
        }
        return response(['error'=> $message],$this->response_status_code)->header('Content-Type', 'application/json');
    }

}
