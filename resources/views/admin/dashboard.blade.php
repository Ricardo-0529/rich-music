@extends('admin.layouts.app')

@section('title', 'Panel principal')

@section('content')

    <section class="admin-welcome">
        <div>
            <span class="admin-eyebrow">RESUMEN GENERAL</span>
            <h1>Bienvenido al panel.</h1>
            <p>
                Administra el contenido de RICH MUSIC desde un solo lugar.
            </p>
        </div>
    </section>

    <section class="admin-cards">

        <article class="admin-card">
            <span>ÁLBUMES REGISTRADOS</span>
            <h2>{{ \App\Models\Album::count() }}</h2>
            <p>Contenido de la discografía</p>
        </article>

        <article class="admin-card">
            <span>CANCIONES</span>
            <h2>{{ \App\Models\Track::count() }}</h2>
            <p>Canciones registradas</p>
        </article>

        <article class="admin-card">
            <span>ENLACES MULTIMEDIA</span>
            <h2>{{ \App\Models\MediaLink::count() }}</h2>
            <p>Plataformas vinculadas</p>
        </article>

    </section>

    <section class="admin-quick-actions">
        <h2>Accesos rápidos</h2>

        <div>
            <a href="{{ route('admin.albums.index') }}">
                Administrar álbumes →
            </a>

            <a href="{{ route('admin.albums.create') }}">
                Registrar nuevo álbum →
            </a>
        </div>
    </section>

@endsection