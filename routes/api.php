<?php

use App\Accounts\Presentation\Http\Controllers\EventController;
use App\Accounts\Presentation\Http\Controllers\GetBalanceController;
use Illuminate\Support\Facades\Route;

Route::get('balance', [GetBalanceController::class, 'getBalance']);
Route::post('event', [EventController::class, 'handle']);
