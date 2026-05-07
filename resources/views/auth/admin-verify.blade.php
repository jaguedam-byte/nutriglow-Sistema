<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificacion de acceso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-shell">
        <section class="auth-brand">
            <span class="eyebrow">NUTRIGLOW</span>
            <h1>Verificacion de acceso</h1>
            <p>Confirma el codigo enviado a tu correo para continuar.</p>
        </section>

        <section class="auth-card">
            <div class="logo-circle">
                <img src="{{ asset('images/logo.png') }}" alt="Logo del sistema">
            </div>

            <h2>Administrador</h2>
            <p>Ingresa el codigo de 6 digitos enviado a {{ $email }}.</p>

            @if ($errors->any())
                <div class="auth-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.admin.verify.post') }}" method="POST" class="auth-form" autocomplete="off">
                @csrf

                <div class="field">
                    <label for="verification_code">Codigo de verificacion</label>
                    <input id="verification_code" name="verification_code" type="text" inputmode="numeric" maxlength="6" placeholder="Ingresa el codigo de 6 digitos" value="{{ old('verification_code') }}" required autofocus autocomplete="one-time-code">
                </div>

                <button type="submit" class="btn-primary">Verificar e ingresar</button>
            </form>

            <div class="auth-footer">
                Si no recibiste el correo, vuelve a iniciar sesion para generar un codigo nuevo.
            </div>
        </section>
    </main>
</body>
</html>
