<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param  null  $message
     */
    public function sendErrorResponse($errors, $message = null, int $code = 422): JsonResponse
    {
        return Response::json([
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public function sendError($error, int $code = 422): JsonResponse
    {
        return Response::json([
            'success' => false,
            'message' => $error,
        ], $code);
    }

    public function sendResponse($result, $message = null, $code = 200): JsonResponse
    {
        return Response::json([
            'data' => $result,
            'message' => $message,
        ], $code);
    }

    public function sendSuccess(string $message): JsonResponse
    {
        return Response::json([
            'success' => true,
            'message' => $message,
        ], 200);
    }
}
