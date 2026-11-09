<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryPhoto extends Model
{
    protected $fillable = [
        'src',
        'alt',
        'category',
        'sort_order',
        'active',
        'featured',
    ];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'active' => 'boolean',
            'featured' => 'boolean',
        ];
    }
}
