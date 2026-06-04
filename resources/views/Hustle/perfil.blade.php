<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Mi Perfil | HUSTLE HOUSE</title>
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
                background-color: #f8f9fa;
                font-family: 'Helvetica Neue', Arial, sans-serif;
            }
            .fw-black { font-weight: 900; }
            
            /* Avatar circular urbano */
            .profile-avatar {
                width: 90px;
                height: 90px;
                background-color: #000000;
                color: #ffffff;
                font-size: 2rem;
                font-weight: 900;
                display: flex;
                align-items: center;
                justify-content: center;
                border-radius: 50%;
                margin: 0 auto 15px auto;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            }

            /* Inputs del formulario estilizados */
            .form-control-profile {
                border-radius: 12px;
                padding: 12px 16px;
                border: 1px solid #dee2e6;
                background-color: #ffffff;
                transition: all 0.2s ease;
            }
            .form-control-profile:focus {
                border-color: #000000;
                box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.05);
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5" style="max-width: 1100px;">
            <!-- CABECERA -->
            <div class="mb-5">
                <h1 class="fw-black text-uppercase tracking-tight m-0">Ajustes de Perfil</h1>
                <p class="text-muted small m-0">Gestiona tu información personal, direcciones de entrega y accesos.</p>
            </div>

            <div class="row g-4">
                <!-- COLUMNA IZQUIERDA: Tarjeta Informativa / Menú Rápido -->
                <div class="col-md-4 col-lg-3">
                    <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white h-100">
                        <div class="profile-avatar">
                            HH
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Hustler Community</h5>
                        <span class="badge bg-dark rounded-pill px-3 py-1.5 small mb-4" style="font-size: 0.7rem; tracking-spacing: 0.5px;">Miembro Drop 01</span>
                        
                        <!-- Navegación interna simulada -->
                        <div class="list-group list-group-flush text-start w-100 border-top pt-3">
                            <a href="#" class="list-group-item list-group-item-action border-0 px-2 fw-bold text-dark">Mi Cuenta</a>
                            <a href="{{ url('/pedidos') }}" class="list-group-item list-group-item-action border-0 px-2 text-secondary">Mis Pedidos</a>
                            <a href="{{ url('/carrito') }}" class="list-group-item list-group-item-action border-0 px-2 text-secondary">Mi Carrito</a>
                        </div>
                    </div>
                </div>

                <!-- COLUMNA DERECHA: Formularios de Edición -->
                <div class="col-md-8 col-lg-9">
                    <div class="d-flex flex-column gap-4">
                        
                        <!-- BLOQUE 1: Información Personal -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            <h4 class="fw-bold text-uppercase tracking-tight mb-4 fs-5 text-dark border-bottom pb-2">Información del Perfil</h4>
                            
                            <form action="#" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Nombre Completo</label>
                                        <input type="text" class="form-control form-control-profile" value="Hustler House User" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Correo Electrónico</label>
                                        <input type="email" class="form-control form-control-profile" value="user@hustlehouse.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Dirección de Envío Principal</label>
                                        <input type="text" class="form-control form-control-profile" value="Av. Central 123, Colonia Streetwear" placeholder="Tu calle, número y colonia" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Ciudad</label>
                                        <input type="text" class="form-control form-control-profile" value="Ciudad de México" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Código Postal</label>
                                        <input type="text" class="form-control form-control-profile" value="01000" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-dark bg-black px-4 py-2.5 rounded-3 fw-bold text-uppercase tracking-wider small" style="font-size: 0.8rem;">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>

                        <!-- BLOQUE 2: Seguridad / Cambiar Contraseña -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                            <h4 class="fw-bold text-uppercase tracking-tight mb-4 fs-5 text-dark border-bottom pb-2">Actualizar Contraseña</h4>
                            
                            <form action="#" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-12">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Contraseña Actual</label>
                                        <input type="password" class="form-control form-control-profile" placeholder="••••••••" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Nueva Contraseña</label>
                                        <input type="password" class="form-control form-control-profile" placeholder="Mínimo 8 caracteres" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label text-secondary small fw-bold text-uppercase" style="font-size: 0.7rem;">Confirmar Contraseña</label>
                                        <input type="password" class="form-control form-control-profile" placeholder="Repite la nueva contraseña" required>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-dark bg-black px-4 py-2.5 rounded-3 fw-bold text-uppercase tracking-wider small" style="font-size: 0.8rem;">Actualizar Credenciales</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </main>
        <footer class="bg-white border-top py-4 text-center text-muted small mt-5">
            <p class="mb-0">&copy; {{ date('Y') }} HUSTLE HOUSE. Todos los derechos reservados.</p>
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
