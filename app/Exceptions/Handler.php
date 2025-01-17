<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if($e instanceof MethodNotAllowedHttpException){
            return response()->json([
               'status' => Response::HTTP_METHOD_NOT_ALLOWED,
               'message' => $e->getMessage(),
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if ($e instanceof ModelNotFoundException){
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => "The requested page does not exist",
            ], Response::HTTP_NOT_FOUND);
        }

        if ($e instanceof NotFoundHttpException){
            return response()->json([
                'status' => Response::HTTP_NOT_FOUND,
                'message' => 'page not found',
            ], Response::HTTP_NOT_FOUND);
        }
        return parent::render($request, $e); // TODO: Change the autogenerated stub
    }
}
