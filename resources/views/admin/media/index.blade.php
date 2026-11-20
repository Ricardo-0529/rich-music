
@extends('admin.layouts.app')

@section('title', 'Multimedia')

@section('content')

<section class="admin-welcome">
    <div>
        <span class="admin-eyebrow">INTEGRACIONES</span>
        <h1>Multimedia</h1>
        <p>Administra los enlaces de música y contenido externo.</p>
    </div>

    <a href="{{ route('admin.media.create') }}" class="admin-primary-button">
        + Nuevo enlace
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
                <th>PLATAFORMA</th>
                <th>ETIQUETA</th>
                <th>CONTENIDO ASOCIADO</th>
                <th>TIPO</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($mediaLinks as $media)
                <tr>
                    <td>{{ $media->platform }}</td>
                    <td>{{ $media->label }}</td>
                    <td>
                        @if ($media->album)
                            Álbum: {{ $media->album->title }}
                        @elseif ($media->track)
                            Canción: {{ $media->track->title }}
                        @else
                            Sin asociación
                        @endif
                    </td>
                    <td>{{ $media->type }}</td>
                    <td>{{ $media->is_active ? 'Activo' : 'Inactivo' }}</td>
                    <td>
                        <div class="admin-actions">
                            <a href="{{ route('admin.media.edit', $media) }}">
                                Editar
                            </a>

                            <form
                                action="{{ route('admin.media.destroy', $media) }}"
                                method="POST"
                                onsubmit="return confirm('¿Eliminar este enlace?')"
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
                        Todavía no hay enlaces multimedia registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="admin-pagination">
    {{ $mediaLinks->links() }}
</div>

@endsection
