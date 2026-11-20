@extends('admin.layouts.app')

@section('title', 'Álbumes')

@section('content')

<section class="admin-welcome">
    <p class="admin-eyebrow">GESTIÓN DEL CATÁLOGO</p>
    <h1>Álbumes<span>.</span></h1>
    <p>Administra los lanzamientos musicales de RICH MUSIC.</p>
</section>

@if (session('success'))
    <div class="admin-success">
        {{ session('success') }}
    </div>
@endif

<div class="album-toolbar">
    <div>
        <strong>{{ $albums->total() }}</strong>
        <span>álbumes registrados</span>
    </div>

    <a href="{{ route('admin.albums.create') }}" class="admin-action">
        + NUEVO ÁLBUM
    </a>
</div>

<div class="admin-table-wrapper">
    <table class="admin-table">

        <thead>
            <tr>
                <th>ÁLBUM</th>
                <th>ERA MUSICAL</th>
                <th>CANCIONES</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($albums as $album)
                <tr>
                    <td>
                        <div class="album-table-info">

                            @if ($album->cover_image)
                                <img
                                    src="{{ $album->cover_image }}"
                                    alt="{{ $album->title }}"
                                >
                            @else
                                <div class="album-table-placeholder">RM</div>
                            @endif

                            <div>
                                <strong>{{ $album->title }}</strong>
                                <small>
                                    {{ $album->release_date?->format('Y') ?? $album->era?->start_year }}
                                </small>
                            </div>

                        </div>
                    </td>

                    <td>{{ $album->era?->name ?? 'Sin era' }}</td>

                    <td>{{ $album->tracks_count }}</td>

                    <td>
                        @if ($album->is_published)
                            <span class="status-label published">Publicado</span>
                        @else
                            <span class="status-label draft">Borrador</span>
                        @endif
                    </td>

                    <td>
                        <div class="table-actions">

                            <a href="{{ route('admin.albums.edit', $album) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('admin.albums.destroy', $album) }}"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este álbum?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit">Eliminar</button>
                            </form>

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5">
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

@endsection