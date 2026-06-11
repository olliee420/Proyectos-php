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
        <main class="container my-5" style="max-width: 900px; font-family: system-ui, -apple-system, sans-serif;">
    <!-- CABECERA DE LA SECCIÓN -->
    <div class="mb-5">
        <h1 class="fw-black text-uppercase tracking-tight m-0" style="font-weight: 900; letter-spacing: -0.5px;">Historial de Pedidos</h1>
        <p class="text-muted small m-0">Revisa el estado de tus drops y compras anteriores.</p>
    </div>

    <!-- LISTADO DE PEDIDOS DINÁMICO (MongoDB) -->
    <div class="d-flex flex-column gap-4">
        
        @forelse($pedidos as $pedido)
            <!-- TARJETA DE PEDIDO DINÁMICA -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <!-- Encabezado de la Tarjeta de Pedido -->
                <div class="card-header bg-black text-white p-4 d-md-flex justify-content-between align-items-center border-0">
                    <div class="d-flex gap-4 flex-wrap mb-3 mb-md-0">
                        <div>
                            <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.65rem; letter-spacing: 0.5px;">Pedido Realizado</span>
                            <span class="fw-semibold" style="font-size: 0.85rem;">
                                {{ isset($pedido->fecha_creacion) ? \Carbon\Carbon::parse($pedido->fecha_creacion)->format('d \d\e M, Y') : 'Sin fecha' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.65rem; letter-spacing: 0.5px;">Total</span>
                            <span class="fw-bold" style="font-size: 0.85rem;">${{ number_format($pedido->total ?? 0, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-white-50 small d-block text-uppercase tracking-wider" style="font-size: 0.65rem; letter-spacing: 0.5px;">ID de Rastreo</span>
                            <span class="font-monospace text-secondary" style="font-size: 0.85rem;">#{{ $pedido->id_rastreo ?? 'HH-XXXXX' }}</span>
                        </div>
                    </div>
                    <div>
                        <!-- Estado dinámico controlado desde MongoDB -->
                        @if(($pedido->estado ?? '') === 'Entregado')
                            <span class="badge bg-success text-white px-2.5 py-1.5 rounded-3" style="font-size: 0.72rem; font-weight: 600;">✅ Entregado</span>
                        @else
                            <span class="badge bg-warning text-dark px-2.5 py-1.5 rounded-3" style="font-size: 0.72rem; font-weight: 600;">🚚 En camino</span>
                        @endif
                    </div>
                </div>

                <!-- Cuerpo de la Tarjeta: Lista de Artículos -->
                <div class="card-body p-4">
                    {{-- Si guardas múltiples artículos en un array dentro del documento de la orden, puedes meter un @foreach aquí --}}
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-3">
                            <div class="order-thumb-container bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; overflow: hidden;">
                                <img src="{{ asset($pedido->imagen_path ?? 'uploads/products/default.jpg') }}" alt="Prenda Hustle" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                            <div>
                                <h6 class="fw-bold m-0 text-dark" style="font-size: 0.95rem;">{{ $pedido->producto_nombre ?? 'Prenda Oficial Drop' }}</h6>
                                <span class="text-muted small">Talla: {{ $pedido->talla ?? 'M' }} | Cantidad: {{ $pedido->cantidad ?? 1 }}</span>
                            </div>
                        </div>
                        <span class="fw-bold text-dark" style="font-size: 0.95rem;">${{ number_format($pedido->precio_unitario ?? $pedido->total ?? 0, 2) }}</span>
                    </div>
                </div>
                
                <!-- Acciones del Pedido -->
                <div class="card-footer bg-light p-3 border-0 d-flex justify-content-end gap-2">
                    @if(($pedido->estado ?? '') === 'Entregado')
                        <a href="{{ route('catalogo') }}" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" style="font-size: 0.75rem;">Comprar de Nuevo</a>
                    @else
                        <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" style="font-size: 0.75rem;">Rastrear Envío</button>
                        <button class="btn btn-sm btn-dark bg-black text-white rounded-pill px-3 fw-semibold" style="font-size: 0.75rem;">Ver Recibo</button>
                    @endif
                </div>
            </div>

        @empty
            <!-- PANTALLA DE ESPERA SÚPER LIMPIA CUANDO EL CLIENTE NO TIENE COMPRAS -->
            <div class="text-center py-5 border border-dashed rounded-4 bg-white shadow-sm mt-2" style="border-style: dashed !important; border-color: #dee2e6 !important;">
                <div class="fs-1 mb-2">📦</div>
                <h4 class="fw-bold text-dark" style="font-size: 1.1rem; letter-spacing: -0.2px;">Aún no has hecho ningún pedido</h4>
                <p class="text-muted small mx-auto mb-0" style="max-width: 360px;">Tus compras de los drops exclusivos de Hustle House aparecerán detalladas en esta sección.</p>
                <a href="{{ route('catalogo') }}" class="btn btn-dark btn-sm mt-3 px-4 py-2 rounded-3 fw-bold text-uppercase tracking-wider" style="font-size: 0.72rem; background: #000; border: 0;">
                    Explorar Drop Actual
                </a>
            </div>
        @endforelse

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
