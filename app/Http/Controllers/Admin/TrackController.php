<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::with('album')
            ->orderBy('album_id')
            ->orderBy('track_number')
            ->paginate(15);

        return view('admin.tracks.index', compact('tracks'));
    }

    public function create()
    {
        $albums = Album::orderBy('title')->get();

        return view('admin.tracks.create', compact('albums'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => ['required', 'exists:albums,id'],
            'title' => ['required', 'string', 'max:255'],
            'track_number' => ['required', 'integer', 'min:1'],
            'duration_seconds' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_explicit'] = $request->boolean('is_explicit');

        Track::create($data);

        return redirect()
            ->route('admin.tracks.index')
            ->with('success', 'Canción registrada correctamente.');
    }

    public function edit(Track $track)
    {
        $albums = Album::orderBy('title')->get();

        return view('admin.tracks.edit', compact('track', 'albums'));
    }

    public function update(Request $request, Track $track)
    {
        $data = $request->validate([
            'album_id' => ['required', 'exists:albums,id'],
            'title' => ['required', 'string', 'max:255'],
            'track_number' => ['required', 'integer', 'min:1'],
            'duration_seconds' => ['nullable', 'integer', 'min:0'],
        ]);

        $data['is_explicit'] = $request->boolean('is_explicit');

        $track->update($data);

        return redirect()
            ->route('admin.tracks.index')
            ->with('success', 'Canción actualizada correctamente.');
    }

    public function destroy(Track $track)
    {
        $track->delete();

        return redirect()
            ->route('admin.tracks.index')
            ->with('success', 'Canción eliminada correctamente.');
    }
}
