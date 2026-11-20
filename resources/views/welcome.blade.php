
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Explora el universo musical de The Weeknd. Descubre sus álbumes, eras y trayectoria artística.">

    <title>RICH MUSIC. — La experiencia de The Weeknd</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <header class="site-header">

        <a href="#home" class="brand">
            RICH MUSIC<span>.</span>
        </a>

        <nav class="main-nav">
            <a href="#home">Inicio</a>
            <a href="#eras">Eras musicales</a>
            <a href="#discography">Discografía</a>
            <a href="#about">Acerca de</a>
        </nav>

        <a href="#discography" class="header-link">
            EXPLORAR <span>↗</span>
        </a>

    </header>

    <main>

        <section class="hero" id="home">

            <div class="hero-background"></div>

            <div class="hero-content">

                <p class="eyebrow">
                    THE WEEKND · EXPERIENCIA MUSICAL
                </p>

                <h1>
                    UN UNIVERSO<br>
                    MÁS ALLÁ DE<br>
                    <span>LA MÚSICA.</span>
                </h1>

                <p class="hero-description">
                    Explora su sonido, descubre sus eras y conoce
                    el universo artístico de The Weeknd.
                </p>

                <a href="#discography" class="primary-button">
                    EXPLORAR DISCOGRAFÍA <span>↗</span>
                </a>

            </div>

            <div class="hero-footer">
                <span>UN RECORRIDO ARTÍSTICO</span>
                <span>EST. 2026</span>
            </div>

            <div class="hero-index">
                01 / 06
            </div>

        </section>

        <section class="intro-section" id="about">

            <div>

                <p class="eyebrow">
                    MÁS QUE MÚSICA
                </p>

                <h2>
                    Un artista.<br>
                    <span>Diferentes mundos.</span>
                </h2>

            </div>

            <p class="intro-description">
                Un recorrido por los sonidos, las imágenes y las historias
                que definen a uno de los artistas más distintivos de
                la música contemporánea.
            </p>

        </section>

        <section class="discography-section" id="discography">

            <div class="section-heading">

                <div>

                    <p class="eyebrow">
                        LA COLECCIÓN
                    </p>

                    <h2>
                        Álbumes destacados<span>.</span>
                    </h2>

                </div>

                <span class="section-number">
                    01 — 06
                </span>

            </div>


<div class="album-grid">

    @forelse ($albums as $album)

        <article class="album-card">

    <a
        href="{{ route('albums.show', $album->slug) }}"
        class="album-card-link"
    >

        <div class="album-art {{
            match ($album->slug) {
                'beauty-behind-the-madness' => 'beauty',
                'dawn-fm' => 'dawn',
                'hurry-up-tomorrow' => 'tomorrow',
                default => $album->slug,
            }
        }}">

            @if ($album->cover_image)
                <img
                    src="{{ $album->cover_image }}"
                    alt="Portada del álbum {{ $album->title }}"
                    class="album-cover"
                    loading="lazy"
                >
            @endif

            <span class="album-year">
                {{ $album->release_date?->format('Y') ?? $album->era?->start_year }}
            </span>

            <span class="album-name">
                {{ $album->title }}
            </span>

        </div>

        <div class="album-info">

            <h3>{{ $album->title }}</h3>

            <span>ÁLBUM DE ESTUDIO</span>

        </div>

    </a>

</article>

    @empty

        <p>No hay álbumes publicados todavía.</p>

    @endforelse

</div>


        </section>

        <section class="eras-section" id="eras">

            <p class="eyebrow">
                UNA EVOLUCIÓN CONSTANTE
            </p>

            <h2>
                Cada era cuenta<br>
                una historia diferente.
            </h2>

            <p>
                Descubre la evolución detrás de la música.
            </p>

        </section>

    </main>

    <footer class="site-footer">

        <a href="#home" class="brand">
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
