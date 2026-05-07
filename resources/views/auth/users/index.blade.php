<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/panel-admin.css') }}">
    <style>
        body.users-page{
            background:
                radial-gradient(circle at top right, rgba(62, 117, 255, 0.18), transparent 24%),
                radial-gradient(circle at top left, rgba(21, 199, 185, 0.16), transparent 22%),
                linear-gradient(135deg, #06070b 0%, #0c1020 45%, #12182a 100%);
            color: #eef3ff;
        }

        .users-page .main-content{
            background: transparent;
        }

        .users-page .topbar{
            background: rgba(7, 10, 18, 0.78);
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(14px);
        }

        .users-page .sidebar{
            background: linear-gradient(180deg, rgba(15, 19, 30, 0.97) 0%, rgba(11, 15, 24, 0.96) 100%);
            border-right: 1px solid rgba(255, 255, 255, 0.06);
        }

        .users-page .brand{
            background: rgba(255, 255, 255, 0.03);
        }

        .users-page .profile-box{
            background: rgba(255, 255, 255, 0.03);
        }

        .users-page .search-box{
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 16px;
        }

        .users-page .menu-item{
            border-left: none;
            border-radius: 14px;
            margin: 0 10px 6px;
        }

        .users-page .menu-item:hover,
        .users-page .menu-item.active{
            background: rgba(122, 103, 255, 0.16);
            box-shadow: inset 0 0 0 1px rgba(110, 164, 255, 0.18);
        }

        .content-box{
            padding: 28px;
        }

        .page-title{
            font-size: 30px;
            margin-bottom: 18px;
            color: #eef3ff;
        }

        .alert{
            padding: 12px 14px;
            border-radius: 6px;
            margin-bottom: 16px;
            font-weight: bold;
        }

        .alert-success{
            background: rgba(52, 223, 192, 0.12);
            color: #66f2d8;
            border: 1px solid rgba(52, 223, 192, 0.18);
        }

        .alert-error{
            background: rgba(255, 92, 131, 0.12);
            color: #ff92ab;
            border: 1px solid rgba(255, 92, 131, 0.18);
        }

        .table-card{
            background: rgba(10, 13, 22, 0.84);
            border-radius: 26px;
            box-shadow: 0 26px 60px rgba(0, 0, 0, 0.28);
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
        }

        .users-table{
            width: 100%;
            border-collapse: collapse;
        }

        .users-table th,
        .users-table td{
            padding: 14px;
            border-top: 1px solid #edf2f7;
            text-align: left;
        }

        .users-table thead{
            background: rgba(255,255,255,0.04);
        }

        .users-table th{
            color: #dfe8ff;
        }

        .role-badge{
            display: inline-block;
            padding: 6px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .role-admin{
            background: rgba(52, 123, 255, 0.18);
            color: #9cc3ff;
        }

        .role-user{
            background: rgba(52, 223, 192, 0.12);
            color: #66f2d8;
        }

        .actions{
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            align-items: center;
        }

        .btn{
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit{
            background: #f39c12;
        }

        .btn-delete{
            background: #e74c3c;
        }

        .top-tools{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 18px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .back-btn{
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255,255,255,0.1);
        }

        .add-user-btn{
            background: linear-gradient(135deg, #2c5d93, #264870);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .modal-overlay{
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-overlay.active{
            display: flex;
        }

        .modal-box{
            background: #121827;
            width: 100%;
            max-width: 520px;
            border-radius: 22px;
            padding: 24px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.25);
            animation: modalFade 0.25s ease;
            border: 1px solid rgba(255,255,255,0.08);
        }

        .modal-title{
            font-size: 26px;
            margin-bottom: 18px;
            color: #eef3ff;
        }

        .modal-form .field{
            margin-bottom: 16px;
        }

        .modal-form label{
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #dbe7ff;
        }

        .modal-form input,
        .modal-form select{
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
            background: rgba(255,255,255,0.04);
            color: #eef3ff;
        }

        .modal-actions{
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel{
            background: rgba(255,255,255,0.06);
        }

        .btn-save{
            background: linear-gradient(135deg, #2c5d93, #264870);
        }

        .error-list{
            background: rgba(255, 92, 131, 0.12);
            color: #ff92ab;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 16px;
            border: 1px solid rgba(255, 92, 131, 0.18);
        }

        /* NUEVOS ESTILOS PARA ICONOS */
        .icon-btn{
            width: 38px;
            height: 38px;
            border-radius: 10px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #fff;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 16px;
        }

        .edit-btn{
            background: #cf8a1e;
        }

        .edit-btn:hover{
            background: #d68910;
            transform: scale(1.05);
        }

        .delete-btn{
            background: #d44d6f;
        }

        .delete-btn:hover{
            background: #c0392b;
            transform: scale(1.05);
        }

        .actions form{
            margin: 0;
        }

        .users-table td{
            color: #bdd0ef;
            border-top: 1px solid rgba(255,255,255,0.08);
        }

        .topbar-left h1,
        .top-user span{
            color: #eef3ff;
        }

        .logout-btn{
            background: #213a52;
            border-radius: 10px;
        }

        @keyframes modalFade{
            from{
                opacity: 0;
                transform: translateY(10px) scale(0.98);
            }
            to{
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>

<body class="users-page">
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

            <div class="search-box">
                <input type="text" placeholder="Buscar...">
                <span>🔍</span>
            </div>

            <div class="menu-title">MODULOS</div>

            <nav class="sidebar-menu">
@if (auth()->user()->role === 'administrador')
    <a href="{{ route('users.index') }}" class="menu-item active">
        <span class="icon">👤</span>
        <span>Usuarios</span>
    </a>
@endif

                <a href="{{ route('panel', ['section' => 'cargas']) }}" class="menu-item">
                    <span class="icon">📸</span>
                    <span>Cargas</span>
                </a>

                <a href="{{ route('panel', ['section' => 'historial']) }}" class="menu-item">
                    <span class="icon">📋</span>
                    <span>Historial</span>
                </a>

                <a href="{{ route('panel', ['section' => 'recetas']) }}" class="menu-item">
                    <span class="icon">🍽️</span>
                    <span>Recetas</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="icon">📊</span>
                    <span>Estadísticas</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="icon">⚙️</span>
                    <span>Configuración</span>
                </a>

                <a href="#" class="menu-item">
                    <span class="icon">🔐</span>
                    <span>Seguridad</span>
                </a>
            </nav>
        </aside>

        <div class="main-content">
            <header class="topbar">
                <div class="topbar-left">
                    <h1>Usuarios registrados</h1>
                </div>

                <div class="topbar-right">
                    <div class="top-user">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                        <span>{{ auth()->user()->name }}</span>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="logout-btn">Cerrar sesión</button>
                    </form>
                </div>
            </header>

            <div class="top-tools">
                <a href="{{ route('panel', ['section' => 'principal']) }}" class="btn back-btn">Volver al panel</a>

                @if (auth()->user()->role === 'administrador')
                    <button type="button" class="btn add-user-btn" id="openUserModal">
                        <i class="fa-solid fa-address-book"></i>
                        Agregar usuario
                    </button>
                @endif
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">{{ session('error') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-list">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="table-card">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'administrador')
                                        <span class="role-badge role-admin">Administrador</span>
                                    @else
                                        <span class="role-badge role-user">Usuario</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="{{ route('users.edit', $user) }}" class="icon-btn edit-btn" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>

                                        @if (auth()->user()->role === 'administrador' && $user->role === 'usuario')
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon-btn delete-btn" title="Eliminar">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No hay usuarios registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (auth()->user()->role === 'administrador')
        <div class="modal-overlay" id="userModal">
            <div class="modal-box">
                <h2 class="modal-title">Agregar usuario</h2>

                <form action="{{ route('users.store') }}" method="POST" class="modal-form">
                    @csrf

                    <div class="field">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="field">
                        <label for="email">Correo</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="field">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <div class="field">
                        <label for="role">Rol</label>
                        <select id="role" name="role" required>
                            <option value="">Seleccione un rol</option>
                            <option value="administrador" {{ old('role') === 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="usuario" {{ old('role') === 'usuario' ? 'selected' : '' }}>Usuario</option>
                        </select>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-cancel" id="closeUserModal">Cancelar</button>
                        <button type="submit" class="btn btn-save">Guardar usuario</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <script>
        const openUserModal = document.getElementById('openUserModal');
        const closeUserModal = document.getElementById('closeUserModal');
        const userModal = document.getElementById('userModal');

        if (openUserModal && userModal) {
            openUserModal.addEventListener('click', () => {
                userModal.classList.add('active');
            });
        }

        if (closeUserModal && userModal) {
            closeUserModal.addEventListener('click', () => {
                userModal.classList.remove('active');
            });
        }

        if (userModal) {
            userModal.addEventListener('click', (e) => {
                if (e.target === userModal) {
                    userModal.classList.remove('active');
                }
            });
        }

        @if ($errors->any())
            if (userModal) {
                userModal.classList.add('active');
            }
        @endif
    </script>
</body>
</html>
