<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="auth-page">
    <main class="auth-shell">
        <section class="auth-brand">
            <span class="eyebrow">NUTRIGLOW</span>
            <h1>Ingreso al sistema</h1>
            <p>Un gran poder conlleva una gran responsabilidad.</p>
        </section>

        <section class="auth-card">
            <div class="logo-circle">
                <img src="{{ asset('images/logo.png') }}" alt="Logo del sistema">
            </div>

            <h2>Bienvenido</h2>
            <p>Ingresa tus credenciales para continuar.</p>

            @if ($errors->any())
                <div class="auth-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="auth-form" autocomplete="off" data-login-form>
                @csrf
                <input id="login_email_payload" type="hidden" name="email" value="">
                <input id="login_password_payload" type="hidden" name="password" value="">

                <div class="field">
                    <label for="login_contact">Correo electrónico</label>
                    <input id="login_contact" type="email" name="login_contact" placeholder="usuario@ejemplo.com" value="{{ old('email') }}" required autofocus autocomplete="off" autocapitalize="off" spellcheck="false" data-lpignore="true" data-1p-ignore="true" data-form-type="other">
                </div>

                <div class="field">
                    <label for="login_secret">Contraseña</label>
                    <input id="login_secret" type="text" name="login_secret" placeholder="Ingresa tu contraseña" required autocomplete="off" autocapitalize="off" spellcheck="false" data-lpignore="true" data-1p-ignore="true" data-form-type="other" style="-webkit-text-security: disc;">
                </div>

                <label for="login_show_password" style="display:flex;align-items:center;gap:10px;color:#dbe7f7;font-weight:700;margin-top:-6px;margin-bottom:4px;cursor:pointer;">
                    <input id="login_show_password" type="checkbox" style="width:18px;height:18px;accent-color:#22bdf4;cursor:pointer;">
                    Mostrar contraseña
                </label>

                <button type="submit" class="btn-primary">Ingresar</button>
            </form>

            <div class="auth-footer">
                Para recuperar tu acceso, solicita soporte al administrador.
            </div>
        </section>
    </main>
    <script>
        (() => {
            const params = new URLSearchParams(window.location.search);

            if (params.get('single_tab') === '1') {
                try {
                    sessionStorage.setItem('nutriglow_panel_single_tab_reauth', '1');
                } catch (error) {
                    // Si el navegador bloquea sessionStorage, el login sigue funcionando normal.
                }
            }
        })();

        const loginForm = document.querySelector('[data-login-form]');
        const loginEmailInput = document.getElementById('login_contact');
        const loginPasswordInput = document.getElementById('login_secret');
        const loginShowPasswordInput = document.getElementById('login_show_password');
        const loginEmailPayload = document.getElementById('login_email_payload');
        const loginPasswordPayload = document.getElementById('login_password_payload');

        if (loginPasswordInput) {
            const clearPasswordInput = () => {
                loginPasswordInput.value = '';
            };

            clearPasswordInput();
            window.addEventListener('pageshow', clearPasswordInput);
            document.addEventListener('DOMContentLoaded', clearPasswordInput);

            ['copy', 'cut', 'paste', 'drop'].forEach((eventName) => {
                loginPasswordInput.addEventListener(eventName, (event) => {
                    event.preventDefault();
                });
            });

            loginShowPasswordInput?.addEventListener('change', () => {
                loginPasswordInput.style.webkitTextSecurity = loginShowPasswordInput.checked ? 'none' : 'disc';
            });
        }

        if (loginForm && loginEmailInput && loginPasswordInput && loginEmailPayload && loginPasswordPayload) {
            loginForm.addEventListener('submit', () => {
                loginEmailPayload.value = loginEmailInput.value;
                loginPasswordPayload.value = loginPasswordInput.value;
            });
        }
    </script>
</body>
</html>
