<?php

use App\Infraestructure\Http\Controllers\EventController;
use App\Infraestructure\Http\Controllers\GetBalanceController;
use Illuminate\Support\Facades\Route;

Route::get('balance', [GetBalanceController::class, 'getBalance']);
Route::post('event', [EventController::class, 'handle']);
