<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Era;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $albums = Album::with('era')
            ->where('is_published', true)
            ->orderBy('release_date')
            ->get();

        $eras = Era::where('is_active', true)
            ->orderBy('start_year')
            ->get();

        return view('welcome', compact('albums', 'eras'));
    }
}
