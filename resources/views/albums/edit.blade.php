@extends('admin.layouts.app')

@section('title', 'Editar álbum')

@section('content')

<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">GESTIÓN DEL CATÁLOGO</p>
        <h1>Editar álbum<span>.</span></h1>
        <p class="admin-description">
            Modifica la información de {{ $album->title }}.
        </p>
    </div>
</div>

@if ($errors->any())
    <div class="admin-alert-error">
        <strong>No se pudieron guardar los cambios.</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="admin-form-card">

    <form action="{{ route('admin.albums.update', $album) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="admin-form-grid">

            <div class="admin-form-group">
                <label for="title">Nombre del álbum *</label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $album->title) }}"
                    required
                >
            </div>

            <div class="admin-form-group">
                <label for="slug">Identificador URL *</label>
                <input
                    type="text"
                    id="slug"
                    name="slug"
                    value="{{ old('slug', $album->slug) }}"
                    required
                >
            </div>

            <div class="admin-form-group">
                <label for="era_id">Era musical *</label>
                <select id="era_id" name="era_id" required>
                    @foreach ($eras as $era)
                        <option
                            value="{{ $era->id }}"
                            @selected(old('era_id', $album->era_id) == $era->id)
                        >
                            {{ $era->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="admin-form-group">
                <label for="release_date">Fecha de lanzamiento</label>
                <input
                    type="date"
                    id="release_date"
                    name="release_date"
                    value="{{ old('release_date', $album->release_date?->format('Y-m-d')) }}"
                >
            </div>

            <div class="admin-form-group full-width">
                <label for="cover_image">URL de la portada</label>
                <input
                    type="url"
                    id="cover_image"
                    name="cover_image"
                    value="{{ old('cover_image', $album->cover_image) }}"
                    placeholder="https://..."
                >
            </div>

            <div class="admin-form-group">
                <label for="album_type">Tipo de lanzamiento *</label>
                <select id="album_type" name="album_type" required>
                    <option value="studio" @selected(old('album_type', $album->album_type) === 'studio')>
                        Álbum de estudio
                    </option>
                    <option value="compilation" @selected(old('album_type', $album->album_type) === 'compilation')>
                        Recopilación
                    </option>
                    <option value="live" @selected(old('album_type', $album->album_type) === 'live')>
                        Álbum en vivo
                    </option>
                    <option value="ep" @selected(old('album_type', $album->album_type) === 'ep')>
                        EP
                    </option>
                </select>
            </div>

            <div class="admin-form-group full-width">
                <label for="description">Descripción</label>
                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Describe esta etapa musical..."
                >{{ old('description', $album->description) }}</textarea>
            </div>

        </div>

        <label class="admin-checkbox">
            <input
                type="checkbox"
                name="is_published"
                value="1"
                @checked(old('is_published', $album->is_published))
            >
            Publicar este álbum en la página principal
        </label>

        <div class="admin-form-footer">
            <a href="{{ route('admin.albums.index') }}" class="admin-secondary-button">
                CANCELAR
            </a>

            <button type="submit" class="admin-primary-button">
                GUARDAR CAMBIOS
            </button>
        </div>

    </form>

</div>

@endsection