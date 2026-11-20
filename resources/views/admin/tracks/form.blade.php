
@csrf

<div class="admin-form-grid">

    <div class="admin-form-group">
        <label for="album_id">Álbum</label>

        <select name="album_id" id="album_id" required>
            <option value="">Selecciona un álbum</option>

            @foreach ($albums as $album)
                <option
                    value="{{ $album->id }}"
                    @selected(old('album_id', $track->album_id ?? '') == $album->id)
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
        <label for="title">Nombre de la canción</label>

        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $track->title ?? '') }}"
            required
        >

        @error('title')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="track_number">Número de pista</label>

        <input
            type="number"
            name="track_number"
            id="track_number"
            min="1"
            value="{{ old('track_number', $track->track_number ?? '') }}"
            required
        >

        @error('track_number')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label for="duration_seconds">Duración en segundos</label>

        <input
            type="number"
            name="duration_seconds"
            id="duration_seconds"
            min="0"
            value="{{ old('duration_seconds', $track->duration_seconds ?? '') }}"
            placeholder="Ej. 240"
        >

        @error('duration_seconds')
            <small>{{ $message }}</small>
        @enderror
    </div>

    <div class="admin-form-group">
        <label>Contenido explícito</label>

        <label class="admin-checkbox-label">
            <input
                type="checkbox"
                name="is_explicit"
                value="1"
                @checked(old('is_explicit', $track->is_explicit ?? false))
            >
            Esta canción contiene contenido explícito
        </label>
    </div>

</div>

<div class="admin-form-actions">
    <a href="{{ route('admin.tracks.index') }}">Cancelar</a>

    <button type="submit" class="admin-primary-button">
        {{ isset($track) ? 'Guardar cambios' : 'Registrar canción' }}
    </button>
</div>
