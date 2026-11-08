<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PriceController;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/prices', [PriceController::class, 'index']);
