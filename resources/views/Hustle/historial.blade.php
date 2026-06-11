<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Title</title>
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
                background-color: #ffffff;
                font-family: 'Helvetica Neue', Arial, sans-serif;
            }

            @keyframes header-ping {
            75%, 100% { transform: scale(2.5); opacity: 0; }
    }

            .fw-black { font-weight: 900; }
            .admin-card {
                border-radius: 16px;
                border: none;
            }
            /* Contenedor simétrico para previsualizar imágenes en las tablas */
            .admin-thumb-container {
                width: 50px;
                height: 50px;
                background-color: #ffffff;
                border: 1px solid #dee2e6;
                border-radius: 8px;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow: hidden;
                padding: 2px;
            }
            .admin-thumb-container img {
                max-height: 100%;
                width: auto;
                object-fit: contain;
            }

    .hover-black:hover {
        background-color: #000000 !important;
        color: #ffffff !important;
        border-color: #000000 !important;
    }
    .hover-danger:hover {
        background-color: #dc3545 !important;
        color: #ffffff !important;
        border-color: #dc3545 !important;
    }
    #userSearch:focus {
        border-color: #000000 !important;
        background-color: #ffffff !important;
    }

        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5">
           <!-- HEADER DEL PANEL: Estilo SaaS Avanzado -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 pb-4 border-bottom border-light-subtle gap-3">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <h1 class="fw-black m-0 tracking-tight text-dark" style="font-size: 1.75rem; font-weight: 900; letter-spacing: -0.8px; text-transform: uppercase;">
                Hustle House Control Panel
            </h1>
            <span class="badge rounded-pill bg-danger-subtle text-danger border border-danger-subtle text-uppercase px-2.5 py-1" style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.5px;">
                Acceso Root
            </span>
        </div>
        <p class="text-secondary m-0 small">Portal de administración para la gestión de productos, inventario y cuentas de usuarios.</p>
    </div>
    
    <!-- Indicador de Estado en Vivo -->
    <div class="bg-success-subtle border border-success-subtle text-success px-3 py-2 rounded-3 d-flex align-items-center gap-2.5 shadow-sm">
        <span class="position-relative d-flex" style="width: 8px; height: 8px;">
            <span class="animate-ping position-absolute inline-flex h-100 w-100 rounded-circle bg-success opacity-75" style="animation: header-ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;"></span>
            <span class="position-relative inline-flex rounded-circle bg-success" style="width: 8px; height: 8px;"></span>
        </span>
        <div class="lh-1">
            <span class="d-block text-uppercase fw-bold text-success-emphasis" style="font-size: 0.65rem; letter-spacing: 0.5px;">Modo Admin Activo</span>
            <span class="text-secondary small font-monospace" style="font-size: 0.72rem;">Administrador Autenticado</span>
        </div>
    </div>
</div>

            <div class="row g-4 mb-5">
                <!-- FORMULARIO DE INGRESO: CATEGORÍAS Y PRODUCTOS -->
                <!-- FORMULARIO DE INGRESO: CATEGORÍAS Y PRODUCTOS -->
<div class="col-lg-5">
    <div class="card border border-light-subtle shadow-sm p-4 bg-white h-100 rounded-4">
        <div class="d-flex align-items-center gap-2 mb-4">
            <span class="fs-5">👕</span>
            <h2 class="m-0 text-dark" style="font-size: 1.05rem; font-weight: 700; letter-spacing: -0.3px;">Agregar Prenda al Drop</h2>
        </div>
        
        <!-- MODIFICACIÓN: Se añade el enctype para permitir la subida de archivos físicos -->
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">

            @csrf
            
            <!-- Selector de Categorías -->
            <div class="mb-3">
                <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">SELECCIONAR CATEGORÍA</label>
                <div class="input-group">
                    <select name="categoria" class="form-select bg-light border-light-subtle py-2.5 px-3" style="font-size: 0.85rem; box-shadow: none;" required>
                        <option value="" selected disabled>Selecciona una categoría...</option>
                        <option value="Camisas Oversize">Camisas Oversize</option>
                        <option value="Hoodies">Hoodies</option>
                        <option value="Gorras">Gorras</option>
                        <option value="Shorts">Shorts</option>
                    </select>
                    <button class="btn btn-outline-secondary border-light-subtle bg-light text-dark px-3" type="button" title="Crear nueva categoría" style="font-size: 0.85rem; font-weight: 600;">+ Nueva</button>
                </div>
            </div>

            <!-- Campos: Nombre y SKU -->
            <div class="row g-3 mb-3">
                <div class="col-8">
                    <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">NOMBRE DEL PRODUCTO</label>
                    <input type="text" name="nombre" class="form-control bg-light border-light-subtle py-2.5 px-3" placeholder="Ej. Hoodie Oversized Hustle" style="font-size: 0.85rem; box-shadow: none;" required>
                </div>
                <div class="col-4">
                    <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">SKU</label>
                    <input type="text" name="sku" class="form-control bg-light border-light-subtle py-2.5 px-3 font-monospace text-uppercase" placeholder="HH-HOOD-001" style="font-size: 0.85rem; box-shadow: none;" required>
                </div>
            </div>

            <!-- Campos: Precios -->
            <div class="row g-3 mb-3">
                <div class="col-6">
                    <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">PRECIO PÚBLICO ($)</label>
                    <input type="number" name="precio" step="0.01" class="form-control bg-light border-light-subtle py-2.5 px-3 fw-semibold text-dark" placeholder="00.00" style="font-size: 0.85rem; box-shadow: none;" required>
                </div>
                <div class="col-6">
                    <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">COSTO DE FÁBRICA ($)</label>
                    <input type="number" name="costo" step="0.01" class="form-control bg-light border-light-subtle py-2.5 px-3 text-secondary" placeholder="00.00" style="font-size: 0.85rem; box-shadow: none;" required>
                </div>
            </div>

            <!-- MODIFICACIÓN: Cambio de tipo texto a tipo archivo (File Input) -->
            <div class="mb-4">
                <label class="form-label text-secondary fw-bold text-uppercase mb-2" style="font-size: 0.68rem; letter-spacing: 0.5px;">SUBIR IMAGEN DEL PRODUCTO</label>
                <input type="file" name="imagen" class="form-control bg-light border-light-subtle py-2 px-3 text-secondary" accept="image/*" style="font-size: 0.85rem; box-shadow: none;" required>
                <div class="form-text text-muted" style="font-size: 0.72rem;">Sube un archivo de tu equipo (PNG, JPG, WEBP).</div>
            </div>

            <!-- Botón Enviar -->
            <button type="submit" class="btn btn-dark w-100 py-3 rounded-3 fw-bold text-uppercase border-0 shadow-sm" style="background: #000; font-size: 0.85rem; letter-spacing: 0.8px;">
                Publicar Prenda Oficial
            </button>
        </form>
    </div>
</div>


                <!-- TABLA: GESTIÓN AVANZADA DE USUARIOS (MongoDB) -->
                <div class="col-lg-7">
    <div class="card border border-light-subtle shadow-sm p-4 bg-white h-100 rounded-4">
        
        <!-- ENCABEZADO DE SECCIÓN CON BUSCADOR -->
        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center gap-3 mb-4">
            <div class="d-flex align-items-center gap-2">
                <span class="fs-5">👥</span>
                <div>
                    <h2 class="m-0 text-dark" style="font-size: 1.05rem; font-weight: 700; letter-spacing: -0.3px;">Usuarios Registrados</h2>
                    <!-- CÓDIGO BLINDADO (No se rompe si es null) -->
                    <small class="text-muted" style="font-size: 0.75rem;">
                        @if(isset($usuarios))
                            {{ count($usuarios) }} {{ count($usuarios) == 1 ? 'usuario registrado' : 'usuarios en total' }}
                        @else
                            Control de cuentas activo
                        @endif
                    </small>

                </div>
            </div>
            <!-- Buscador dinámico -->
            <div class="position-relative w-100 w-sm-auto">
                <input type="text" id="userSearch" class="form-control bg-light border-light-subtle py-2 px-3 ps-5" placeholder="Buscar usuario o correo..." style="font-size: 0.82rem; box-shadow: none; border-radius: 8px;">
                <span class="position-absolute top-50 start-0 translate-middle-y ps-3 text-secondary" style="font-size: 0.85rem;">🔍</span>
            </div>
        </div>
        
        <!-- CONTENEDOR LIMITADO CON SCROLL: Evita que la tabla crezca infinitamente -->
        <div class="table-responsive" style="max-height: 420px; overflow-y: auto; scrollbar-width: thin;">
            <table class="table table-hover align-middle mb-0" id="userTable">
                <thead class="position-sticky top-0 bg-white" style="z-index: 2; box-shadow: 0 1px 0 #dee2e6;">
                    <tr>
                        <th class="text-secondary fw-bold border-0 pb-3" style="font-size: 0.68rem; letter-spacing: 0.5px; width: 40%;">USUARIO / CORREO</th>
                        <th class="text-secondary fw-bold border-0 pb-3 text-center" style="font-size: 0.68rem; letter-spacing: 0.5px; width: 15%;">ROL</th>
                        <th class="text-secondary fw-bold border-0 pb-3" style="font-size: 0.68rem; letter-spacing: 0.5px; width: 20%;">REGISTRO</th>
                        <th class="text-secondary fw-bold border-0 pb-3 text-center" style="font-size: 0.68rem; letter-spacing: 0.5px; width: 25%;">ACCIONES DE CONTROL</th>
                    </tr>
                </thead>
                <tbody class="border-0" style="font-size: 0.85rem;">
                    
                    @forelse($usuarios as $usuario)
                        @php
                            // Aseguramos formato array por compatibilidad con colecciones NoSQL directas
                            $userArr = (array)$usuario;
                        @endphp
                        
                        <tr class="user-row border-bottom border-light-subtle">
                            <!-- Nombre y Correo Reales de DB -->
                            <td class="py-3">
                                <span class="d-block fw-semibold text-dark mb-0.5 search-target">{{ $userArr['nombre'] ?? 'Sin Nombre' }}</span>
                                <small class="text-muted font-monospace search-target" style="font-size: 0.72rem;">{{ $userArr['email'] ?? 'sin-correo' }}</small>
                            </td>
                            
                            <!-- Rol Dinámico Real de DB -->
                            <td class="text-center py-3">
                                @if(($userArr['rol'] ?? 'cliente') === 'admin')
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 0.65rem; font-weight: 700; border-radius: 5px;">Admin</span>
                                @else
                                    <span class="badge bg-dark-subtle text-dark border border-dark-subtle px-2 py-1" style="font-size: 0.65rem; font-weight: 700; border-radius: 5px;">Cliente</span>
                                @endif
                            </td>
                            
                            <!-- Fecha de Registro Real de DB -->
                            <td class="text-secondary py-3" style="font-size: 0.8rem;">
                                @if(isset($userArr['fecha_creacion']))
                                    {{ \Carbon\Carbon::parse($userArr['fecha_creacion'])->format('d M Y') }}
                                @else
                                    Sin Fecha
                                @endif
                            </td>
                            
                            <!-- Acciones Dinámicas Seguras -->
                            <td class="py-3">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="#" class="btn btn-light btn-sm border-light-subtle rounded-2 text-dark px-2.5 py-1 fw-semibold transition-all hover-black" style="font-size: 0.75rem;">
                                        📊 Movimientos
                                    </a>

                                    @if(($userArr['rol'] ?? 'cliente') === 'admin')
                                        <!-- Blindaje: Bloquear eliminación de administradores -->
                                        <button class="btn btn-light btn-sm border-0 text-muted px-2 py-1" disabled title="No puedes eliminar a un Administrador">
                                            ❌
                                        </button>
                                    @else
                                        <!-- Formulario de borrado seguro mapeando el ID único de MongoDB -->
                                        <form action="{{ route('admin.users.destroy', $usuario->_id ?? $userArr['_id'] ?? $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás 100% seguro de eliminar permanentemente a este cliente?')">

                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm rounded-2 border-light-subtle bg-light text-danger px-2.5 py-1 fw-semibold transition-all hover-danger" style="font-size: 0.75rem;">
                                                ❌ Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <!-- Estado vacío real si la DB no tiene registros -->
                        <tr>
                            <td colspan="4" class="text-center py-5 text-secondary">
                                <div class="fs-4 mb-2">👥</div>
                                <p class="m-0 small fw-medium text-dark">No hay usuarios registrados en la base de datos.</p>
                            </td>
                        </tr>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
         <script>
    // 1. Buscador en tiempo real
    document.getElementById('userSearch').addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('.user-row');
        
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            if(text.includes(filter)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // 2. Confirmación básica antes de disparar el backend
    function confirmarEliminacion(nombreUsuario) {
        if (confirm(`¿Estás seguro de que deseas eliminar permanentemente a "${nombreUsuario}" de la base de datos de Hustle House? Esta acción no se puede deshacer.`)) {
            alert('Llamando a la ruta de eliminación en Laravel...');
            // Aquí puedes enviar un formulario oculto de borrado mediante JS
        }
    }
</script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
