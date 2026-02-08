<?php

use App\Infraestructure\Http\Controllers\GetBalanceController;
use Illuminate\Support\Facades\Route;

Route::get('balance', [GetBalanceController::class, 'getBalance']);
