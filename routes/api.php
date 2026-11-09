<?php

use App\Http\Controllers\GalleryPhotoController;
use App\Http\Controllers\SiteSettingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PriceController;

Route::get('/services', [ServiceController::class, 'index']);
Route::get('/prices', [PriceController::class, 'index']);

Route::get('/gallery/featured', [GalleryPhotoController::class, 'featured']);
Route::get('/gallery', [GalleryPhotoController::class, 'index']);

Route::get('/settings', [SiteSettingController::class, 'index']);
