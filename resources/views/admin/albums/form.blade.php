@if ($errors->any())
    <div class="admin-errors">
        <strong>Hay algunos errores que debes corregir:</strong>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="album-form-grid">

    <div class="admin-form-field">
        <label for="title">Nombre del álbum *</label>
        <input
            type="text"
            id="title"
            name="title"
            value="{{ old('title', $album?->title) }}"
            placeholder="Ej. After Hours"
            required
        >
    </div>

    <div class="admin-form-field">
        <label for="slug">Identificador URL *</label>
        <input
            type="text"
            id="slug"
            name="slug"
            value="{{ old('slug', $album?->slug) }}"
            placeholder="after-hours"
            required
        >
    </div>

    <div class="admin-form-field">
        <label for="era_id">Era musical *</label>

        <select name="era_id" id="era_id" required>
            <option value="">Selecciona una era</option>

            @foreach ($eras as $era)
                <option
                    value="{{ $era->id }}"
                    @selected(old('era_id', $album?->era_id) == $era->id)
                >
                    {{ $era->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="admin-form-field">
        <label for="release_date">Fecha de lanzamiento</label>
        <input
            type="date"
            id="release_date"
            name="release_date"
            value="{{ old('release_date', $album?->release_date?->format('Y-m-d')) }}"
        >
    </div>

    <div class="admin-form-field full">
        <label for="cover_image">URL de la portada</label>
        <input
            type="url"
            id="cover_image"
            name="cover_image"
            value="{{ old('cover_image', $album?->cover_image) }}"
            placeholder="https://..."
        >
    </div>

    <div class="admin-form-field">
        <label for="album_type">Tipo de lanzamiento</label>

        <select name="album_type" id="album_type" required>
            <option value="studio" @selected(old('album_type', $album?->album_type ?? 'studio') === 'studio')>
                Álbum de estudio
            </option>

            <option value="live" @selected(old('album_type', $album?->album_type) === 'live')>
                Álbum en vivo
            </option>

            <option value="compilation" @selected(old('album_type', $album?->album_type) === 'compilation')>
                Recopilación
            </option>
        </select>
    </div>

    <div class="admin-form-field full">
        <label for="description">Descripción</label>

        <textarea
            name="description"
            id="description"
            rows="5"
            placeholder="Describe esta etapa musical..."
        >{{ old('description', $album?->description) }}</textarea>
    </div>

    <div class="admin-form-field full">
        <label class="publish-option">
            <input
                type="checkbox"
                name="is_published"
                value="1"
                @checked(old('is_published', $album?->is_published ?? false))
            >
            Publicar este álbum en la página principal
        </label>
    </div>

</div>

<div class="admin-form-actions">

    <a href="{{ route('admin.albums.index') }}" class="admin-cancel">
        CANCELAR
    </a>

    <button type="submit" class="admin-action">
        {{ $album?->exists ? 'GUARDAR CAMBIOS' : 'REGISTRAR ÁLBUM' }}
    </button>

</div>