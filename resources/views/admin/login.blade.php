<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acceso administrativo — RICH MUSIC.</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-body">

    <main class="login-container">

        <a href="{{ route('home') }}" class="brand">
            RICH MUSIC<span>.</span>
        </a>

        <div class="login-content">

            <p class="admin-eyebrow">ACCESO RESTRINGIDO</p>

            <h1>Bienvenido<span>.</span></h1>

            <p class="login-description">
                Ingresa tus credenciales para administrar RICH MUSIC.
            </p>

            @if ($errors->any())
                <div class="login-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST">

                @csrf

                <div class="admin-field">
                    <label for="email">Correo electrónico</label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="tu@correo.com"
                        required
                        autofocus
                    >
                </div>

                <div class="admin-field">
                    <label for="password">Contraseña</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Tu contraseña"
                        required
                    >
                </div>

                <label class="remember-field">
                    <input type="checkbox" name="remember" value="1">
                    Recordar sesión
                </label>

                <button type="submit" class="admin-submit">
                    INICIAR SESIÓN <span>↗</span>
                </button>

            </form>

        </div>

        <p class="login-footer">
            RICH MUSIC · PANEL DE ADMINISTRACIÓN · 2026
        </p>

    </main>

</body>
</html>