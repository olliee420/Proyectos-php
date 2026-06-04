<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Login</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
        <style>
            body {
                background-color: #0b0b0b;
                font-family: 'Helvetica Neue', Arial, sans-serif;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }
            .fw-black { font-weight: 900; }
            
            /* Contenedor principal de acceso */
            .auth-container {
                max-width: 950px;
                background-color: #121212;
                border: 1px solid #222;
                border-radius: 24px;
                overflow: hidden;
            }

            /* Estilos de los campos de texto urbanos */
            .form-control-dark {
                background-color: #1a1a1a !important;
                border: 1px solid #333 !important;
                color: #ffffff !important;
                padding: 12px 16px;
                border-radius: 12px;
                transition: all 0.3s ease;
            }
            .form-control-dark:focus {
                border-color: #ffffff !important;
                box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1) !important;
            }
            .form-control-dark::placeholder {
                color: #555555;
            }

            /* Animaciones de desvanecimiento dinámico */
            .auth-fade {
                transition: opacity 0.3s ease, transform 0.3s ease;
            }
            .d-none-auth {
                display: none;
                opacity: 0;
                transform: translateY(10px);
            }

            /* Imagen lateral con filtro de marca */
            .auth-sidebar-img {
                background-image: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2)), url('https://unsplash.com');
                background-size: cover;
                background-position: center;
                min-height: 450px;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-auto py-5 flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="row auth-container w-100 shadow-lg g-0">
        
        <!-- COLUMNA IZQUIERDA: Arte / Branding de la marca -->
        <div class="col-md-6 d-none d-md-flex flex-column justify-content-end p-5 auth-sidebar-img position-relative">
            <div class="position-relative z-1 text-white">
                <span class="badge bg-white text-black mb-2 rounded-pill px-3 fw-bold">DROP 01</span>
                <h2 class="fw-black text-uppercase tracking-wide m-0 fs-1">HUSTLE HOUSE</h2>
                <p class="text-white-50 small m-0">Únete a la cultura urbana. Rastrea tus pedidos y obtén acceso exclusivo a drops limitados.</p>
            </div>
        </div>

        <!-- COLUMNA DERECHA: Formularios Interactivos -->
        <div class="col-md-6 p-4 p-sm-5 d-flex flex-column justify-content-center bg-black">
            
            <!-- ALERTA DE ERRORES GLOBAL -->
            @if ($errors->any())
                <div class="alert alert-danger bg-dark text-danger border-danger small py-2 mb-3 rounded-3">
                    <ul class="m-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <!-- ================= FORMULARIO 1: INICIAR SESIÓN ================= -->
            <div id="loginForm" class="auth-fade">
                <div class="mb-4">
                    <h3 class="text-white fw-black text-uppercase tracking-tight m-0">Bienvenido de vuelta</h3>
                    <p class="text-muted small">Ingresa tus credenciales urbanas.</p>
                </div>

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-white-50 small fw-bold uppercase">Email</label>
                        <input type="email" name="email" class="form-control form-control-dark" value="{{ old('email') }}" placeholder="tu@email.com" required>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <label class="form-label text-white-50 small fw-bold">Contraseña</label>
                            <a href="#" class="text-muted small text-decoration-none hover-light">¿La olvidaste?</a>
                        </div>
                        <div class="input-group">
                            <input type="password" id="loginPassword" name="password" class="form-control form-control-dark border-end-0" placeholder="••••••••" required>
                            <button class="btn btn-dark border-secondary border-start-0 text-white-50 px-3" type="button" onclick="togglePasswordVisibility('loginPassword', this)">
                                👁️
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-light w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wider mb-4 shadow">
                        Entrar a la Casa
                    </button>
                </form>

                <div class="text-center">
                    <p class="text-muted small m-0">¿No tienes una cuenta aún?</p>
                    <button onclick="toggleAuthView('register')" class="btn btn-link text-white fw-bold text-decoration-none p-0 small mt-1">
                        Registrarse / Crear Cuenta &rarr;
                    </button>
                </div>
            </div>

            <!-- ================= FORMULARIO 2: REGISTRARSE ================= -->
            <div id="registerForm" class="auth-fade d-none-auth">
                <div class="mb-4">
                    <h3 class="text-white fw-black text-uppercase tracking-tight m-0">Crear Cuenta</h3>
                    <p class="text-muted small">Regístrate para comprar y revisar tus pedidos.</p>
                </div>

                <form action="{{ route('registro.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label text-white-50 small fw-bold">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control form-control-dark" value="{{ old('nombre') }}" placeholder="Tu Nombre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-white-50 small fw-bold">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control form-control-dark" value="{{ old('email') }}" placeholder="nombre@ejemplo.com" required>
                    </div>
                    
                    <div class="row g-2 mb-4">
                        <div class="col-6">
                            <label class="form-label text-white-50 small fw-bold">Contraseña</label>
                            <div class="input-group">
                                <input type="password" id="registerPassword" name="password" class="form-control form-control-dark border-end-0" placeholder="••••••••" required>
                                <button class="btn btn-dark border-secondary border-start-0 text-white-50 px-2" type="button" onclick="togglePasswordVisibility('registerPassword', this)">
                                    👁️
                                </button>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label text-white-50 small fw-bold">Confirmar</label>
                            <div class="input-group">
                                <input type="password" id="confirmPassword" name="password_confirmation" class="form-control form-control-dark border-end-0" placeholder="••••••••" required>
                                <button class="btn btn-dark border-secondary border-start-0 text-white-50 px-2" type="button" onclick="togglePasswordVisibility('confirmPassword', this)">
                                    👁️
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-light w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wider mb-4 shadow">
                        Registrarse Ahora
                    </button>
                </form>

                <div class="text-center">
                    <p class="text-muted small m-0">¿Ya formas parte de la comunidad?</p>
                    <button onclick="toggleAuthView('login')" class="btn btn-link text-white fw-bold text-decoration-none p-0 small mt-1">
                        &larr; Volver al Login
                    </button>
                </div>
            </div>

        </div>
    </div>
</main>

    <footer>
        <!-- place footer here -->

    </footer>

<script>
function toggleAuthView(view) {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    
    if (view === 'register') {
        loginForm.classList.add('d-none');
        registerForm.classList.remove('d-none-auth', 'd-none');
    } else {
        registerForm.classList.add('d-none');
        loginForm.classList.remove('d-none');
    }
}

function togglePasswordVisibility(inputId, button) {
    const passwordInput = document.getElementById(inputId);
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        button.innerHTML = "🙈";
    } else {
        passwordInput.type = "password";
        button.innerHTML = "👁️";
    }
}
</script>


<style>
    /* Corrección estética para integrar el botón del ojo sin cortes visuales */
    .input-group .form-control-dark {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }
    .input-group .btn {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        transition: background-color 0.2s;
    }
    .input-group .btn:hover {
        background-color: #212529 !important;
        color: #fff !important;
    }
</style>



    </body>
</html>
