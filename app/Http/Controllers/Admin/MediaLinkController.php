<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\MediaLink;
use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MediaLinkController extends Controller
{
    public function index()
    {
        $mediaLinks = MediaLink::with(['album', 'track'])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15);

        return view('admin.media.index', compact('mediaLinks'));
    }

    public function create()
    {
        $albums = Album::orderBy('title')->get();
        $tracks = Track::with('album')
            ->orderBy('album_id')
            ->orderBy('track_number')
            ->get();

        return view('admin.media.create', compact('albums', 'tracks'));
    }

    public function store(Request $request)
    {
        $data = $this->validateMediaLink($request);

        MediaLink::create($data);

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Enlace multimedia registrado correctamente.');
    }

    public function edit(MediaLink $media)
    {
        $albums = Album::orderBy('title')->get();
        $tracks = Track::with('album')
            ->orderBy('album_id')
            ->orderBy('track_number')
            ->get();

        return view('admin.media.edit', compact('media', 'albums', 'tracks'));
    }

    public function update(Request $request, MediaLink $media)
    {
        $data = $this->validateMediaLink($request);

        $media->update($data);

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Enlace multimedia actualizado correctamente.');
    }

    public function destroy(MediaLink $media)
    {
        $media->delete();

        return redirect()
            ->route('admin.media.index')
            ->with('success', 'Enlace multimedia eliminado correctamente.');
    }

    private function validateMediaLink(Request $request): array
    {
        $data = $request->validate([
            'album_id' => ['nullable', 'required_without:track_id', 'exists:albums,id'],
            'track_id' => ['nullable', 'required_without:album_id', 'exists:tracks,id'],
            'platform' => ['required', 'string', 'max:50'],
            'type' => ['required', 'string', 'max:50'],
            'label' => ['required', 'string', 'max:255'],
            'url' => ['required', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if (
            !empty($data['album_id']) &&
            !empty($data['track_id'])
        ) {
            throw ValidationException::withMessages([
                'album_id' => 'Selecciona un álbum o una canción, no ambos.',
            ]);
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }
}
