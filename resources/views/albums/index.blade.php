@extends('admin.layouts.app')

@section('title', 'Álbumes')

@section('content')

<div class="admin-page-header">
    <div>
        <p class="admin-eyebrow">GESTIÓN DEL CATÁLOGO</p>
        <h1>Álbumes<span>.</span></h1>
        <p class="admin-description">
            Administra los lanzamientos musicales de RICH MUSIC.
        </p>
    </div>

    <a href="{{ route('admin.albums.create') }}" class="admin-primary-button">
        + NUEVO ÁLBUM
    </a>
</div>

@if (session('success'))
    <div class="admin-alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="admin-alert-error">
        Revisa los datos del formulario.
    </div>
@endif

<div class="admin-table-card">

    <div class="admin-table-heading">
        <h2>Catálogo de álbumes</h2>
        <span>{{ $albums->total() }} álbumes registrados</span>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ÁLBUM</th>
                    <th>ERA MUSICAL</th>
                    <th>LANZAMIENTO</th>
                    <th>CANCIONES</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($albums as $album)
                    <tr>
                        <td>
                            <div class="admin-album-cell">
                                @if ($album->cover_image)
                                    <img
                                        src="{{ $album->cover_image }}"
                                        alt="Portada de {{ $album->title }}"
                                    >
                                @else
                                    <div class="admin-album-placeholder">♫</div>
                                @endif

                                <div>
                                    <strong>{{ $album->title }}</strong>
                                    <small>{{ $album->release_date?->format('Y') ?? $album->era?->start_year ?? '—' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>{{ $album->era?->name ?? 'Sin era' }}</td>

                        <td>
                            {{ $album->release_date?->format('d/m/Y') ?? '—' }}
                        </td>

                        <td>{{ $album->tracks_count }}</td>

                        <td>
                            @if ($album->is_published)
                                <span class="admin-status published">Publicado</span>
                            @else
                                <span class="admin-status draft">Borrador</span>
                            @endif
                        </td>

                        <td>
                            <div class="admin-actions">
                                <a href="{{ route('admin.albums.edit', $album) }}">
                                    Editar
                                </a>

                                <form
                                    action="{{ route('admin.albums.destroy', $album) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Seguro que deseas eliminar este álbum y su contenido asociado?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="admin-delete-button">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="admin-empty">
                            Todavía no hay álbumes registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="admin-pagination">
        {{ $albums->links() }}
    </div>

</div>

@endsection