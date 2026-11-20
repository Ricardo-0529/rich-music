<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Administración') — RICH MUSIC</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-dashboard">

    <aside class="admin-sidebar">

        <a href="{{ route('admin.dashboard') }}" class="brand">
            RICH MUSIC<span>.</span>
        </a>

        <p class="sidebar-label">ADMINISTRACIÓN</p>

        <nav>

            <a href="{{ route('admin.dashboard') }}"
                class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>▦</span>
                Panel principal
            </a>

            <a href="{{ route('admin.albums.index') }}"
                class="{{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                <span>♫</span>
                Álbumes
            </a>

            <a href="{{ route('admin.tracks.index') }}"
    class="{{ request()->routeIs('admin.tracks.*') ? 'active' : '' }}">
    <span>≡</span> Canciones
</a>

            <a href="{{ route('admin.media.index') }}"
    class="{{ request()->routeIs('admin.media.*') ? 'active' : '' }}">
    <span>▧</span> Multimedia
</a>

        </nav>

        <div class="admin-sidebar-bottom">

            <a href="{{ route('home') }}" target="_blank">
                Ver sitio público ↗
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf

                <button type="submit" class="logout-button">
                    Cerrar sesión ↗
                </button>
            </form>

        </div>

    </aside>

    <main class="admin-main">

        <header class="admin-topbar">
            <span>Panel de administración</span>
            <span>{{ auth()->user()->name }}</span>
        </header>

        <div class="admin-content">
            @yield('content')
        </div>

    </main>

</body>

</html>