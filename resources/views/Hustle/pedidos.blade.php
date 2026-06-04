<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>HUSTLE HOUSE</title>
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
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5" style="max-width: 900px;">
            <!-- CABECERA DE LA SECCIÓN -->
            <div class="mb-5">
                <h1 class="fw-black text-uppercase tracking-tight m-0">Historial de Pedidos</h1>
                <p class="text-muted small m-0">Revisa el estado de tus drops y compras anteriores.</p>
            </div>

            <!-- LISTADO DE PEDIDOS (Simulado para la interfaz) -->
            <div class="d-flex flex-column gap-4">
                
                <!-- PEDIDO 1: EN CAMINO -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <!-- Encabezado de la Tarjeta de Pedido -->
                    <div class="card-header bg-black text-white p-4 d-md-flex justify-content-between align-items-center border-0">
                        <div class="d-flex gap-4 flex-wrap mb-3 mb-md-0">
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">Pedido Realizado</span>
                                <span class="fw-semibold">24 de Mayo, 2026</span>
                            </div>
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">Total</span>
                                <span class="fw-bold">$99.98</span>
                            </div>
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">ID de Rastreo</span>
                                <span class="font-monospace text-secondary">#HH-98214</span>
                            </div>
                        </div>
                        <div>
                            <!-- Estado dinámico -->
                            <span class="badge badge-street bg-warning text-dark">🚚 En camino</span>
                        </div>
                    </div>

                    <!-- Cuerpo de la Tarjeta: Artículos comprados -->
                    <div class="card-body p-4">
                        <!-- Artículo 1 -->
                        <div class="d-flex align-items-center justify-content-between pb-3 mb-3 border-b border-light border-bottom">
                            <div class="d-flex align-items-center gap-3">
                                <div class="order-thumb-container">
                                    <img src="https://unsplash.com" alt="Playera Hustle">
                                </div>
                                <div>
                                    <h6 class="fw-bold m-0 text-dark">Playera Oversize "Hustle"</h6>
                                    <span class="text-muted small">Talla: L | Cantidad: 1</span>
                                </div>
                            </div>
                            <span class="fw-bold text-dark">$39.99</span>
                        </div>

                        <!-- Artículo 2 -->
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="order-thumb-container">
                                    <img src="https://unsplash.com" alt="Hoodie House">
                                </div>
                                <div>
                                    <h6 class="fw-bold m-0 text-dark">Hoodie Minimalist "House"</h6>
                                    <span class="text-muted small">Talla: XL | Cantidad: 1</span>
                                </div>
                            </div>
                            <span class="fw-bold text-dark">$59.99</span>
                        </div>
                    </div>
                    
                    <!-- Acciones del Pedido -->
                    <div class="card-footer bg-light p-3 border-0 d-flex justify-content-end gap-2">
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Rastrear Envío</button>
                        <button class="btn btn-sm btn-dark bg-black text-white rounded-pill px-3">Ver Recibo</button>
                    </div>
                </div>


                <!-- PEDIDO 2: ENTREGADO -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="card-header bg-black text-white p-4 d-md-flex justify-content-between align-items-center border-0">
                        <div class="d-flex gap-4 flex-wrap mb-3 mb-md-0">
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">Pedido Realizado</span>
                                <span class="fw-semibold">12 de Abril, 2026</span>
                            </div>
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">Total</span>
                                <span class="fw-bold">$39.99</span>
                            </div>
                            <div>
                                <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.7rem;">ID de Rastreo</span>
                                <span class="font-monospace text-secondary">#HH-95412</span>
                            </div>
                        </div>
                        <div>
                            <span class="badge badge-street bg-success text-white">✅ Entregado</span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="order-thumb-container">
                                    <img src="https://unsplash.com" alt="Playera Hustle">
                                </div>
                                <div>
                                    <h6 class="fw-bold m-0 text-dark">Playera Oversize "Hustle"</h6>
                                    <span class="text-muted small">Talla: M | Cantidad: 1</span>
                                </div>
                            </div>
                            <span class="fw-bold text-dark">$39.99</span>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light p-3 border-0 d-flex justify-content-end gap-2">
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Comprar de Nuevo</button>
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
