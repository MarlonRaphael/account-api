<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GetBalanceController extends Controller
{
    public function getBalance(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'OK'
        ]);
    }
}
