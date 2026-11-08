<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceResource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return ServiceResource::collection(
            Service::query()
                ->where('active', true)
                ->orderBy('sort_order')
                ->get()
        );
    }
}
