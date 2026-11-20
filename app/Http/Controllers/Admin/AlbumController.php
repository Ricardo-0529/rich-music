<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Era;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::with('era')
            ->withCount('tracks')
            ->orderBy('id')
            ->paginate(10);

        return view('admin.albums.index', compact('albums'));
    }

    public function create()
    {
        $eras = Era::where('is_active', true)->orderBy('start_year')->get();

        return view('admin.albums.create', compact('eras'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'era_id' => ['required', 'exists:eras,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:albums,slug'],
            'release_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'album_type' => ['required', 'string', 'max:50'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        Album::create($data);

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Álbum registrado correctamente.');
    }

    public function edit(Album $album)
    {
        $eras = Era::where('is_active', true)->orderBy('start_year')->get();

        return view('admin.albums.edit', compact('album', 'eras'));
    }

    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'era_id' => ['required', 'exists:eras,id'],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'alpha_dash',
                Rule::unique('albums', 'slug')->ignore($album->id),
            ],
            'release_date' => ['nullable', 'date'],
            'cover_image' => ['nullable', 'url', 'max:2048'],
            'description' => ['nullable', 'string'],
            'album_type' => ['required', 'string', 'max:50'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $album->update($data);

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Álbum actualizado correctamente.');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        return redirect()
            ->route('admin.albums.index')
            ->with('success', 'Álbum y su contenido asociado eliminados.');
    }
}