<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

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
        $this->renderable(function (NotFoundHttpException $exception) {
            return response('The url cannot be found',404);
        });
        $this->renderable(function (MethodNotAllowedException $exception){
            return response($exception->getMessage(), 405);
        });
        $this->renderable(function (RouteNotFoundException $exception) {
            return response($exception->getMessage(),404);
        });
        $this->renderable(function (ModelNotFoundException $exception) {
            $modelName = strtolower(class_basename($exception->getModel()));
            $errorMessage = 'Does not exists any ' . $modelName . ' with the specified data';
            return response($errorMessage);
        });
        $this->renderable(function (AuthorizationException $exception) {
            return response($exception->getMessage(),403);
        });
        $this->renderable(function (ValidationException $exception) {
            return response($exception->validator->errors(), 422);
        });
        $this->renderable(function (AuthenticationException $exception, $request) {
            return $this->unauthenticated($request, $exception);
        });
        $this->renderable(function (\Exception $exception) {
            return response($exception->getMessage(), 500);
        });
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->is('api/*')) {
            return response('Unauthenticated.', 403);
        }
        return redirect()->back();
    }
}
