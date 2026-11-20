<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $album->title }} — RICH MUSIC.</title>

    <meta name="description"
        content="Descubre {{ $album->title }}, parte del universo musical de The Weeknd.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header">

        <a href="{{ route('home') }}" class="brand">
            RICH MUSIC<span>.</span>
        </a>

        <nav class="main-nav">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('home') }}#eras">Eras musicales</a>
            <a href="{{ route('home') }}#discography">Discografía</a>
            <a href="{{ route('home') }}#about">Acerca de</a>
        </nav>

        <a href="{{ route('home') }}#discography" class="header-link">
            VOLVER <span>↗</span>
        </a>

    </header>

    <main>

        <section class="album-detail">

            <div class="album-detail-art">

                @if ($album->cover_image)
                    <img
                        src="{{ $album->cover_image }}"
                        alt="Portada de {{ $album->title }}"
                    >
                @endif

            </div>

            <div class="album-detail-content">

                <p class="eyebrow">
                    THE WEEKND · ÁLBUM DE ESTUDIO
                </p>

                <h1>{{ $album->title }}</h1>

                <p class="album-detail-year">
                    {{ $album->release_date?->format('Y') ?? $album->era?->start_year }}
                </p>

                <p class="album-detail-description">
                    {{ $album->description ?? $album->era?->description ?? 'Explora esta etapa del universo musical de The Weeknd.' }}
                </p>

                <a href="{{ route('home') }}#discography" class="primary-button">
                    VOLVER A LA DISCOGRAFÍA <span>↗</span>
                </a>

            </div>

        </section>

                @if ($album->tracks->isNotEmpty())

            <section class="tracklist-section">

                <div class="section-heading">

                    <div>
                        <p class="eyebrow">
                            EL CONTENIDO DEL ÁLBUM
                        </p>

                        <h2>
                            Lista de canciones<span>.</span>
                        </h2>
                    </div>

                    <span class="section-number">
                        {{ str_pad($album->tracks->count(), 2, '0', STR_PAD_LEFT) }}
                        CANCIONES
                    </span>

                </div>

                <div class="tracklist">

                    @foreach ($album->tracks as $track)

                        <article class="track-row">

                            <span class="track-number">
                                {{ str_pad($track->track_number, 2, '0', STR_PAD_LEFT) }}
                            </span>

                            <h3>{{ $track->title }}</h3>

                            <span class="track-duration">
                                @if ($track->duration_seconds)
                                    {{ gmdate('i:s', $track->duration_seconds) }}
                                @else
                                    —
                                @endif
                            </span>

                        </article>

                    @endforeach

                </div>

            </section>

@if ($album->mediaLinks->isNotEmpty())

    <section class="platform-section">

        <p class="eyebrow">
            CONTINÚA LA EXPERIENCIA
        </p>

        <h2>
            Explora el álbum<span>.</span>
        </h2>

        <p class="platform-description">
            Escucha y descubre la música de The Weeknd
            a través de sus plataformas oficiales.
        </p>

        <div class="platform-links">

            @foreach ($album->mediaLinks as $link)

                <a
                    href="{{ $link->url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="platform-button"
                >

                    <span>
                        {{ $link->label }}
                    </span>

                    <span class="platform-arrow">↗</span>

                </a>

            @endforeach

        </div>

    </section>

@endif

        @endif

    </main>

    <footer class="site-footer">

        <a href="{{ route('home') }}" class="brand">
            RICH MUSIC<span>.</span>
        </a>

        <p>
            UNA EXPERIENCIA INDEPENDIENTE PARA FANS · 2026
        </p>

        <span>
            CREADO PARA LOS AMANTES DE LA MÚSICA.
        </span>

    </footer>

</body>
</html>