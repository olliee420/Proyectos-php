<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Carrito</title>
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
        
        <main class="container my-5">
            <!-- CABECERA -->
            <div class="mb-5">
                <h1 class="fw-black text-uppercase tracking-tight m-0">Bolsa de Compra</h1>
                <p class="text-muted small m-0">Tienes <span class="fw-bold text-dark">2 artículos</span> en tu carrito.</p>
            </div>

            <div class="row g-4">
                <!-- COLUMNA IZQUIERDA: Lista de productos agregados -->
                <div class="col-lg-8">
                    <div class="d-flex flex-column gap-3">
                        
                        <!-- ARTÍCULO 1 -->
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap gap-3">
                                <!-- Miniatura Completa -->
                                <div class="cart-img-container shadow-sm flex-shrink-0 mx-auto mx-sm-0">
                                    <img src="https://unsplash.com" alt="Playera Hustle">
                                </div>
                                
                                <!-- Detalles -->
                                <div class="flex-grow-1 text-center text-sm-start">
                                    <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.65rem;">Playeras</span>
                                    <h5 class="fw-bold text-dark my-1 fs-6">Playera Oversize "Hustle"</h5>
                                    <p class="text-secondary small mb-0">Talla: <span class="fw-semibold text-dark">L</span> | Color: <span class="fw-semibold text-dark">Negro</span></p>
                                </div>

                                <!-- Selector de Cantidad Intuitivo -->
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-pill p-1 mx-auto mx-sm-0">
                                    <button class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold">&minus;</button>
                                    <input type="text" class="qty-input" value="1" readonly>
                                    <button class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold">&plus;</button>
                                </div>

                                <!-- Precio y Eliminar -->
                                <div class="text-center text-sm-end flex-shrink-0 ps-sm-3 mx-auto mx-sm-0 w-100 w-sm-auto mt-2 mt-sm-0">
                                    <span class="fw-black text-dark fs-5 d-block">\$39.99</span>
                                    <button class="btn btn-link text-danger text-decoration-none small p-0 mt-1" style="font-size: 0.85rem;">
                                        ✕ Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- ARTÍCULO 2 -->
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap gap-3">
                                <div class="cart-img-container shadow-sm flex-shrink-0 mx-auto mx-sm-0">
                                    <img src="https://unsplash.com" alt="Hoodie House">
                                </div>
                                
                                <div class="flex-grow-1 text-center text-sm-start">
                                    <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.65rem;">Sudaderas</span>
                                    <h5 class="fw-bold text-dark my-1 fs-6">Hoodie Minimalist "House"</h5>
                                    <p class="text-secondary small mb-0">Talla: <span class="fw-semibold text-dark">XL</span> | Color: <span class="fw-semibold text-dark">Gris</span></p>
                                </div>

                                <div class="d-flex align-items-center justify-content-center bg-light rounded-pill p-1 mx-auto mx-sm-0">
                                    <button class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold">&minus;</button>
                                    <input type="text" class="qty-input" value="1" readonly>
                                    <button class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold">&plus;</button>
                                </div>

                                <div class="text-center text-sm-end flex-shrink-0 ps-sm-3 mx-auto mx-sm-0 w-100 w-sm-auto mt-2 mt-sm-0">
                                    <span class="fw-black text-dark fs-5 d-block">\$59.99</span>
                                    <button class="btn btn-link text-danger text-decoration-none small p-0 mt-1" style="font-size: 0.85rem;">
                                        ✕ Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Botón para regresar al catálogo abajo de la lista -->
                    <a href="{{ url('/catalogo') }}" class="btn btn-link text-dark fw-bold text-decoration-none p-0 mt-4 d-inline-block">
                        &larr; Continuar comprando ropa
                    </a>
                </div>

                <!-- COLUMNA DERECHA: Resumen financiero del pedido -->
                <div class="col-lg-4">
                    <div class="card summary-card border-0 shadow-sm p-4">
                        <h4 class="fw-black text-uppercase tracking-tight mb-4 fs-5">Resumen de Orden</h4>
                        
                        <!-- Desglose -->
                        <div class="d-flex flex-column gap-3 border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between text-secondary small">
                                <span>Subtotal de prendas</span>
                                <span class="fw-semibold text-dark">\$99.98</span>
                            </div>
                            <div class="d-flex justify-content-between text-secondary small">
                                <span>Envío estimado</span>
                                <span class="text-success fw-bold text-uppercase" style="font-size: 0.75rem;">Gratis</span>
                            </div>
                            
                            <!-- Input simulado para cupones de descuento -->
                            <div class="input-group input-group-sm mt-2">
                                <input type="text" class="form-control bg-light border-0" placeholder="Código de descuento">
                                <button class="btn btn-dark bg-black px-3" type="button">Aplicar</button>
                            </div>
                        </div>

                        <!-- Total definitivo -->
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold text-dark">Total estimado</span>
                            <span class="fw-black text-dark fs-3">\$99.98</span>
                        </div>

                        <!-- Botón de acción principal llamativo -->
                        <button class="btn btn-dark bg-black text-white w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wider shadow">
                            Proceder al Pago ➔
                        </button>
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
