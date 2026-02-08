<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('balance', function (Request $request) {

    $request->validate([
        'account_id' => ['required', 'integer'],
    ]);

    $accountId = (int) $request->query('account_id');

    $existingAccountId = 123;

    if ($accountId !== $existingAccountId) {
        return response()->json(0, Response::HTTP_NOT_FOUND);
    }

    return response()->json([20], Response::HTTP_OK);
});
