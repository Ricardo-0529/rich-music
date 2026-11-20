<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function show(string $slug): View
    {
        $album = Album::with([
            'era',
            'tracks' => function ($query) {
                $query->orderBy('track_number');
            },
            'mediaLinks' => function ($query) {
                $query->where('is_active', true)
                    ->orderBy('sort_order');
            },
        ])
        ->where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

        return view('albums.show', compact('album'));
    }
}