<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">
    <style>
        body.edit-user-page{
            background:
                radial-gradient(circle at top right, rgba(62, 117, 255, 0.18), transparent 24%),
                radial-gradient(circle at top left, rgba(21, 199, 185, 0.16), transparent 22%),
                linear-gradient(135deg, #06070b 0%, #0c1020 45%, #12182a 100%);
            color: #eef3ff;
        }

        .edit-user-page .main-content{
            background: transparent;
        }

        .edit-user-page .topbar{
            background: rgba(7, 10, 18, 0.78);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
        }

        .edit-user-page .sidebar{
            background: linear-gradient(180deg, rgba(15, 19, 30, 0.97) 0%, rgba(11, 15, 24, 0.96) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        .edit-user-page .brand{
            background: rgba(255, 255, 255, 0.03);
        }

        .edit-user-page .profile-box{
            background: rgba(255, 255, 255, 0.03);
        }

        .edit-user-page .menu-item{
            border-left: none;
            border-radius: 14px;
            margin: 0 10px 6px;
        }

        .edit-user-page .menu-item:hover,
        .edit-user-page .menu-item.active{
            background: rgba(122, 103, 255, 0.16);
            box-shadow: inset 0 0 0 1px rgba(110, 164, 255, 0.18);
        }

        .content-box{
            padding: 28px;
        }

        .form-card{
            background: rgba(10, 13, 22, 0.84);
            max-width: 700px;
            border-radius: 26px;
            padding: 24px;
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.28);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }

        .page-title{
            font-size: 28px;
            margin-bottom: 20px;
            color: #eef3ff;
        }

        .field{
            margin-bottom: 18px;
        }

        .field label{
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #dbe7ff;
        }

        .field input,
        .field select{
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            outline: none;
            background: rgba(255,255,255,0.04);
            color: #eef3ff;
        }

        .btn{
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-save{
            background: linear-gradient(135deg, #2c5d93, #264870);
        }

        .btn-back{
            background: rgba(255,255,255,0.06);
            margin-right: 10px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .actions-row{
            margin-top: 10px;
        }

        .error-list{
            background: rgba(255, 92, 131, 0.12);
            color: #ff92ab;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 92, 131, 0.18);
        }

        .topbar-left h1{
            color: #eef3ff;
        }

        .logout-btn{
            background: #213a52;
            border-radius: 10px;
        }
    </style>
</head>
<body class="edit-user-page">
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="brand">
                <span class="brand-strong">Nutri</span><span class="brand-light">Glow Admin</span>
            </div>

            <div class="profile-box">
                <div class="profile-avatar">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <div class="profile-info">
                    <h3>{{ auth()->user()->name }}</h3>
                    <p><span class="status-dot"></span> En linea</p>
                </div>
            </div>

            <div class="menu-title">MODULOS</div>

            <nav class="sidebar-menu">
                <a href="{{ route('users.index') }}" class="menu-item active">
                    <span class="icon">👤</span>
                    <span>Usuarios</span>
                </a>
            </nav>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <h1>Editar usuario</h1>
                </div>

                <div class="topbar-right">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Cerrar sesión</button>
                    </form>
                </div>
            </header>

            <div class="content-box">
                <div class="form-card">
                    <h2 class="page-title">Modificar datos del usuario</h2>

                    @if ($errors->any())
                        <div class="error-list">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="field">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="field">
                            <label for="email">Correo</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <div class="field">
                            <label for="role">Rol</label>
                            <select id="role" name="role" required>
                                <option value="administrador" {{ old('role', $user->role) === 'administrador' ? 'selected' : '' }}>Administrador</option>
                                <option value="usuario" {{ old('role', $user->role) === 'usuario' ? 'selected' : '' }}>Usuario</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="password">Nueva contraseña (opcional)</label>
                            <input type="password" id="password" name="password" placeholder="Déjalo vacío si no deseas cambiarla">
                        </div>

                        <div class="actions-row">
                            <a href="{{ route('users.index') }}" class="btn btn-back">Volver</a>
                            <button type="submit" class="btn btn-save">Guardar cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
