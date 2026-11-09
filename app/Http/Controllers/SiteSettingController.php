<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends Controller
{
    public function index(): JsonResponse
    {
        $setting = SiteSetting::query()->first();

        if (!$setting) {
            return response()->json([
                'data' => null,
            ]);
        }

        $maps = null;

        if (filled($setting->address)) {
            $address = urlencode($setting->address);

            $maps = [
                'google_maps' => "https://www.google.com/maps/search/?api=1&query={$address}",
                'apple_maps' => "https://maps.apple.com/?q={$address}",
                'waze' => "https://waze.com/ul?q={$address}&navigate=yes",
            ];
        }

        return response()->json([
            'data' => [
                'business_name' => $setting->business_name,
                'description' => $setting->description,
                'full_description' => $setting->full_description,
                'phone' => $setting->phone,
                'whatsapp' => $setting->whatsapp,
                'email' => $setting->email,
                'address' => $setting->address,
                'opening_hours' => $setting->opening_hours,
                'social_links' => $setting->social_links,
                'maps' => $maps,
            ],
        ]);
    }
}
