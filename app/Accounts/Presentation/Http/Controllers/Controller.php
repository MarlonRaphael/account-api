<?php

namespace App\Accounts\Presentation\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class Controller
{
    protected function respondNotFound(): JsonResponse
    {
        return response()->json(0, Response::HTTP_NOT_FOUND);
    }
}

