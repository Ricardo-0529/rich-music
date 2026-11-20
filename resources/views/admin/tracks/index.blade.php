
@extends('admin.layouts.app')

@section('title', 'Canciones')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">CATÁLOGO MUSICAL</span>
        <h1>Canciones</h1>
        <p>Administra las pistas de los álbumes de RICH MUSIC.</p>
    </div>

    <a href="{{ route('admin.tracks.create') }}" class="admin-primary-button">
        + Nueva canción
    </a>
</section>

@if (session('success'))
    <div class="admin-success-message">
        {{ session('success') }}
    </div>
@endif

<div class="admin-table-container">
    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>CANCIÓN</th>
                <th>ÁLBUM</th>
                <th>DURACIÓN</th>
                <th>EXPLÍCITA</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tracks as $track)
                <tr>
                    <td>{{ $track->track_number }}</td>
                    <td>{{ $track->title }}</td>
                    <td>{{ $track->album?->title ?? 'Sin álbum' }}</td>
                    <td>
                        @if ($track->duration_seconds !== null)
                            {{ sprintf(
                                '%d:%02d',
                                intdiv($track->duration_seconds, 60),
                                $track->duration_seconds % 60
                            ) }}
                        @else
                            —
                        @endif
                    </td>
                    <td>{{ $track->is_explicit ? 'Sí' : 'No' }}</td>
                    <td>
                        <div class="admin-actions">
                            <a href="{{ route('admin.tracks.edit', $track) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('admin.tracks.destroy', $track) }}"
                                method="POST"
                                onsubmit="return confirm('¿Eliminar esta canción?')"
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
                    <td colspan="6">
                        Todavía no hay canciones registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="admin-pagination">
    {{ $tracks->links() }}
</div>

@endsection
