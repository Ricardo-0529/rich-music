
@csrf

<div class="admin-form-grid">

    <div class="admin-form-group">
        <label for="platform">Plataforma</label>

        <select name="platform" id="platform" required>
            <option value="">Selecciona una plataforma</option>

            @foreach ([
                'spotify' => 'Spotify',
                'apple_music' => 'Apple Music',
                'youtube' => 'YouTube'
            ] as $value => $label)
                <option
                    value="{{ $value }}"
                    @selected(old('platform', $media->platform ?? '') === $value)
                >
                    {{ $label }}
                </option>
            @endforeach
        </select>

        @error('platform')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="type">Tipo de enlace</label>

        <select name="type" id="type" required>
            <option value="">Selecciona el tipo</option>

            @foreach ([
                'streaming' => 'Streaming',
                'video' => 'Video'
            ] as $value => $label)
                <option
                    value="{{ $value }}"
                    @selected(old('type', $media->type ?? '') === $value)
                >
                    {{ $label }}
                </option>
            @endforeach
        </select>

        @error('type')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="label">Nombre del enlace</label>

        <input
            type="text"
            name="label"
            id="label"
            value="{{ old('label', $media->label ?? '') }}"
            placeholder="Ej. Escuchar en Spotify"
            required
        >

        @error('label')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="url">URL</label>

        <input
            type="url"
            name="url"
            id="url"
            value="{{ old('url', $media->url ?? '') }}"
            placeholder="https://..."
            required
        >

        @error('url')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="album_id">Álbum asociado</label>

        <select name="album_id" id="album_id">
            <option value="">Ninguno</option>

            @foreach ($albums as $album)
                <option
                    value="{{ $album->id }}"
                    @selected(old('album_id', $media->album_id ?? '') == $album->id)
                >
                    {{ $album->title }}
                </option>
            @endforeach
        </select>

        @error('album_id')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="track_id">Canción asociada</label>

        <select name="track_id" id="track_id">
            <option value="">Ninguna</option>

            @foreach ($tracks as $track)
                <option
                    value="{{ $track->id }}"
                    @selected(old('track_id', $media->track_id ?? '') == $track->id)
                >
                    {{ $track->album?->title }} — {{ $track->title }}
                </option>
            @endforeach
        </select>

        @error('track_id')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="sort_order">Orden de visualización</label>

        <input
            type="number"
            name="sort_order"
            id="sort_order"
            min="0"
            value="{{ old('sort_order', $media->sort_order ?? 0) }}"
        >
    </div>

    <div class="admin-form-group">
        <label class="admin-checkbox-label">
            <input
                type="checkbox"
                name="is_active"
                value="1"
                @checked(old('is_active', $media->is_active ?? true))
            >
            Enlace activo
        </label>
    </div>

</div>

<div class="admin-form-actions">
    <a href="{{ route('admin.media.index') }}">Cancelar</a>

    <button type="submit" class="admin-primary-button">
        {{ isset($media) ? 'Guardar cambios' : 'Registrar enlace' }}
    </button>
</div>
