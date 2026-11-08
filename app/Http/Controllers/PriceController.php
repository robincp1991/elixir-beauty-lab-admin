<?php

namespace App\Http\Controllers;

use App\Http\Resources\PriceResource;
use App\Models\Price;

class PriceController extends Controller
{
    public function index()
    {
        return PriceResource::collection(
            Price::query()
                ->where('active', true)
                ->orderBy('sort_order')
                ->get()
        );
    }
}
