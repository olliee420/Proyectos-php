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
        
        <main class="container my-5" style="font-family: system-ui, -apple-system, sans-serif;">
    
    <!-- CONDICIONAL: Si el carrito tiene productos (reales de la sesión o DB) -->
    @if(isset($carrito) && count($carrito) > 0)
        
        <!-- CABECERA CON CONTADOR DINÁMICO -->
        <div class="mb-5">
            <h1 class="fw-black text-uppercase tracking-tight m-0" style="font-weight: 900; letter-spacing: -0.5px;">Bolsa de Compra</h1>
            <p class="text-muted small m-0">Tienes <span class="fw-bold text-dark">{{ count($carrito) }} {{ count($carrito) == 1 ? 'artículo' : 'artículos' }}</span> en tu carrito.</p>
        </div>

        <div class="row g-4">
            <!-- COLUMNA IZQUIERDA: Lista de productos agregados -->
            <div class="col-lg-8">
                <div class="d-flex flex-column gap-3">
                    
                    @foreach($carrito as $id => $item)
                        <!-- ARTÍCULO DINÁMICO -->
                        <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                            <div class="d-flex align-items-center flex-wrap flex-sm-nowrap gap-3">
                                <!-- Miniatura Completa -->
                                <div class="cart-img-container shadow-sm flex-shrink-0 mx-auto mx-sm-0 bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; overflow: hidden;">
                                    <img src="{{ asset($item['imagen_path'] ?? 'uploads/products/default.jpg') }}" alt="{{ $item['nombre'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                
                                <!-- Detalles -->
                                <div class="flex-grow-1 text-center text-sm-start">
                                    <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.65rem;">{{ $item['categoria'] ?? 'Prenda' }}</span>
                                    <h5 class="fw-bold text-dark my-1 fs-6">{{ $item['nombre'] }}</h5>
                                    <p class="text-secondary small mb-0">Talla: <span class="fw-semibold text-dark">{{ $item['talla'] ?? 'M' }}</span></p>
                                </div>

                                <!-- Selector de Cantidad -->
                                <div class="d-flex align-items-center justify-content-center bg-light rounded-pill p-1 mx-auto mx-sm-0">
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold rounded-circle" style="width:28px; height:28px; p-0; display:flex; align-items:center; justify-content:center;">&minus;</button>
                                    </form>
                                    <input type="text" class="qty-input text-center bg-transparent border-0 fw-bold text-dark mx-2" value="{{ $item['cantidad'] }}" style="width: 25px; font-size: 0.9rem;" readonly>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-light btn-qty bg-white shadow-sm fw-bold rounded-circle" style="width:28px; height:28px; p-0; display:flex; align-items:center; justify-content:center;">&plus;</button>
                                    </form>
                                </div>

                                <!-- Precio y Eliminar -->
                                <div class="text-center text-sm-end flex-shrink-0 ps-sm-3 mx-auto mx-sm-0 w-100 w-sm-auto mt-2 mt-sm-0">
                                    <span class="fw-black text-dark fs-5 d-block">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</span>
                                    <form action="#" method="POST" onsubmit="return confirm('¿Remover este artículo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger text-decoration-none small p-0 mt-1" style="font-size: 0.82rem; font-weight: 500;">
                                            ✕ Eliminar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Botón para regresar al catálogo -->
                <a href="{{ route('catalogo') }}" class="btn btn-link text-dark fw-bold text-decoration-none p-0 mt-4 d-inline-block small" style="font-size: 0.85rem;">
                    &larr; Continuar comprando ropa
                </a>
            </div>

            <!-- COLUMNA DERECHA: Resumen financiero del pedido -->
            <div class="col-lg-4">
                <div class="card summary-card border border-light-subtle bg-white shadow-sm p-4 rounded-4">
                    <h4 class="fw-black text-uppercase tracking-tight mb-4 text-dark" style="font-size: 1.05rem; font-weight: 700; letter-spacing: -0.3px;">Resumen de Orden</h4>
                    
                    <!-- Desglose -->
                    <div class="d-flex flex-column gap-3 border-bottom pb-4 mb-4">
                        <div class="d-flex justify-content-between text-secondary small">
                            <span>Subtotal de prendas</span>
                            <span class="fw-semibold text-dark">${{ number_format($totalEstimado ?? 0, 2) }}</span>
                        </div>
                        <div class="d-flex justify-content-between text-secondary small">
                            <span>Envío estimado</span>
                            <span class="text-success fw-bold text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Gratis</span>
                        </div>
                        
                        <!-- Input para cupones -->
                        <div class="input-group input-group-sm mt-2">
                            <input type="text" class="form-control bg-light border-0 py-2 px-3" placeholder="Código de descuento" style="font-size: 0.8rem; border-radius: 6px 0 0 6px; box-shadow: none;">
                            <button class="btn btn-dark bg-black px-3" type="button" style="font-size: 0.8rem; border-radius: 0 6px 6px 0;">Aplicar</button>
                        </div>
                    </div>

                    <!-- Total definitivo -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold text-dark" style="font-size: 0.9rem;">Total estimado</span>
                        <span class="fw-black text-dark fs-3" style="font-weight: 900;">${{ number_format($totalEstimado ?? 0, 2) }}</span>
                    </div>

                    <!-- Botón de Checkout -->
                    <button class="btn btn-dark bg-black text-white w-100 py-3 rounded-3 fw-bold text-uppercase tracking-wider border-0 shadow" style="font-size: 0.82rem; letter-spacing: 0.5px;">
                        Proceder al Pago ➔
                    </button>
                </div>
            </div>
        </div>

    <!-- PANTALLA QUE SE MUESTRA SI NO HAY NADA EN EL CARRITO -->
    @else
        <div class="text-center py-5 border border-dashed rounded-4 bg-white shadow-sm my-5" style="border-style: dashed !important; border-color: #dee2e6 !important;">
            <div class="fs-1 mb-2">🛒</div>
            <h1 class="fw-black text-uppercase tracking-tight text-dark m-0 mb-2" style="font-size: 1.4rem; font-weight: 800;">Tu bolsa está vacía</h1>
            <p class="text-muted small mx-auto mb-0" style="max-width: 380px;">No has agregado ninguna prenda del drop a tu bolsa de compras todavía.</p>
            <a href="{{ route('catalogo') }}" class="btn btn-dark btn-sm mt-4 px-4 py-2.5 rounded-3 fw-bold text-uppercase tracking-wider" style="font-size: 0.72rem; background: #000; border: 0;">
                Ver Drop Actual
            </a>
        </div>
    @endif

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
