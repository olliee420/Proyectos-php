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
                background-color: #f4f6f9;
                font-family: 'Helvetica Neue', Arial, sans-serif;
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
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5">
            <!-- HEADER DEL PANEL -->
            <div class="mb-5 bg-black text-white p-4 rounded-4 d-flex justify-content-between align-items-center shadow-sm">
                <div>
                    <span class="badge bg-danger text-uppercase mb-1" style="letter-spacing: 0.5px;">Acceso Root</span>
                    <h1 class="fw-black text-uppercase m-0 tracking-tight" style="font-size: 1.8rem;">Hustle House Control Panel</h1>
                </div>
                <div class="text-end d-none d-md-block">
                    <span class="text-white-50 small d-block">Administrador Autenticado</span>
                    <span class="fw-bold text-warning">🛡️ Modo Admin Activo</span>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <!-- FORMULARIO DE INGRESO: CATEGORÍAS Y PRODUCTOS -->
                <div class="col-lg-5">
                    <div class="card admin-card shadow-sm p-4 bg-white h-100">
                        <h4 class="fw-black text-uppercase fs-5 mb-4 border-bottom pb-2 text-dark">📦 Agregar Prenda al Drop</h4>
                        
                        <form action="#" method="POST">
                            @csrf
                            <!-- Selector e inserción de Categorías exlusivas -->
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">SELECCIONAR CATEGORÍA</label>
                                <div class="input-group">
                                    <select class="form-select py-2 rounded-start-3" required>
                                        <option value="" selected disabled>Selecciona una categoría...</option>
                                        <option value="Camisas Oversize">Camisas Oversize</option>
                                        <option value="Hoodies">Hoodies</option>
                                        <option value="Gorras">Gorras</option>
                                        <option value="Shorts">Shorts</option>
                                    </select>
                                    <!-- Botón para crear categorías dinámicas futuras -->
                                    <button class="btn btn-outline-dark" type="button" title="Crear nueva categoría">&#43; Nueva</button>
                                </div>
                            </div>

                            <!-- Campos de información de la prenda -->
                            <div class="row g-2 mb-3">
                                <div class="col-8">
                                    <label class="form-label small fw-bold text-secondary">NOMBRE DEL PRODUCTO</label>
                                    <input type="text" class="form-control py-2" placeholder="Ej. Hoodie Oversized Hustle" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label small fw-bold text-secondary">SKU</label>
                                    <input type="text" class="form-control py-2 font-monospace text-uppercase" placeholder="HH-HOOD-001" required>
                                </div>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-secondary">PRECIO PÚBLICO (\$)</label>
                                    <input type="number" step="0.01" class="form-control py-2" placeholder="45.00" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-secondary">COSTO DE FÁBRICA (\$)</label>
                                    <input type="number" step="0.01" class="form-control py-2" placeholder="18.00" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">URL O NOMBRE DE LA IMAGEN</label>
                                <input type="text" class="form-control py-2" placeholder="Ej. 1_c1eFJH.webp" required>
                            </div>

                            <button type="submit" class="btn btn-dark bg-black w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wider shadow-sm">
                                Publicar Prenda Oficial
                            </button>
                        </form>
                    </div>
                </div>

                <!-- TABLA 1: HISTORIAL DE VENTAS (Mapeado de Ordenes_manuales) -->
                <div class="col-lg-7">
                    <div class="card admin-card shadow-sm p-4 bg-white h-100">
                        <h4 class="fw-black text-uppercase fs-5 mb-4 border-bottom pb-2 text-dark">🛒 Historial de Ventas Directas</h4>
                        
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-uppercase" style="font-size: 0.72rem;">
                                    <tr>
                                        <th>ID Mongo</th>
                                        <th>Cliente / Sucursal</th>
                                        <th>Prenda Adquirida</th>
                                        <th>Total</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 0.82rem;">
                                    <!-- Registro de ejemplo real de tu DB -->
                                    <tr>
                                        <td class="font-monospace fw-bold text-secondary">#1</td>
                                        <td>
                                            <span class="d-block fw-bold text-dark">Jennifer Cardona</span>
                                            <small class="text-muted">📍 Santa Ana (Delivery Local)</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-dark text-white border-0 px-2 py-1">Hoodie Hustle</span>
                                            <small class="d-block text-muted mt-1">Talla: M | Cant: 1</small>
                                        </td>
                                        <td class="fw-black text-dark">\$45.00</td>
                                        <td><span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1">Entregado</span></td>
                                    </tr>
                                    <!-- Registro 2 -->
                                    <tr>
                                        <td class="font-monospace fw-bold text-secondary">#2</td>
                                        <td>
                                            <span class="d-block fw-bold text-dark">Jennifer Cardona</span>
                                            <small class="text-muted">📍 Santa Ana (Delivery Local)</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary text-white border-0 px-2 py-1">Camisa Acid Wash</span>
                                            <small class="d-block text-muted mt-1">Talla: L | Cant: 2</small>
                                        </td>
                                        <td class="fw-black text-dark">\$70.00</td>
                                        <td><span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2.5 py-1">En Camino</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
