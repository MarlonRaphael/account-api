<?php

use App\Presentation\Account\Http\Controllers\EventController;
use App\Presentation\Account\Http\Controllers\GetBalanceController;
use Illuminate\Support\Facades\Route;

Route::get('balance', [GetBalanceController::class, 'getBalance']);
Route::post('event', [EventController::class, 'handle']);
