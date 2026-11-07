<?php

use Illuminate\Support\Facades\Route;

Route::get('/services', function (){
    return \App\Models\Service::all();});

Route::get('/prices', function (){
    return \App\Models\Price::all();
});
