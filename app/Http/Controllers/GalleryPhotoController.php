<?php

namespace App\Http\Controllers;

use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Storage;

class GalleryPhotoController extends Controller
{
    /**
     * Fotografías destacadas para la página inicial.
     */
    public function featured()
    {
        $photos = GalleryPhoto::query()
            ->where('active', true)
            ->where('featured', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'data' => $photos->map(fn ($photo) => [
                'id' => $photo->id,
                'src' => Storage::disk('r2')->url($photo->src),
                'alt' => $photo->alt,
                'category' => $photo->category,
                'sort_order' => $photo->sort_order,
            ]),
        ]);
    }

    /**
     * Todas las fotografías activas para la galería.
     */
    public function index()
    {
        $photos = GalleryPhoto::query()
            ->where('active', true)
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'data' => $photos->map(fn ($photo) => [
                'id' => $photo->id,
                'src' => Storage::disk('r2')->url($photo->src),
                'alt' => $photo->alt,
                'category' => $photo->category,
                'sort_order' => $photo->sort_order,
            ]),
        ]);
    }
}
