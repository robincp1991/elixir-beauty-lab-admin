<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'business_name',
        'description',
        'full_description',
        'phone',
        'whatsapp',
        'email',
        'address',
        'opening_hours',
        'social_links',
        'seo_title',
        'seo_description',
    ];

    protected function casts(): array
    {
        return [
            'opening_hours' => 'array',
            'social_links' => 'array',
        ];
    }
}
