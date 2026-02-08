<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return response()
        ->setStatusCode(Response::HTTP_OK)
        ->json([
            'message' => 'OK',
        ]);
});
