<!doctype html>
<html lang="es" data-bs-theme="light">
    <head>
        <title>Catalogo</title>
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
            
        .evaluation-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 .5rem 1.5rem rgba(0,0,0,.08)!important;
    }
</style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5" style="font-family: system-ui, -apple-system, sans-serif;">
    <!-- Título y Filtros -->
    <div class="d-md-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="fw-black text-uppercase tracking-tight m-0" style="font-weight: 900; letter-spacing: -0.5px;">Catálogo de Ropa</h1>
            <p class="text-muted small m-0">Drop 01 — El arte de mantener el ritmo urbano.</p>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
            <button class="btn btn-sm btn-dark rounded-pill px-3 fw-semibold" style="font-size: 0.78rem;">Todos</button>
            <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" style="font-size: 0.78rem;">Playeras</button>
            <button class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" style="font-size: 0.78rem;">Sudaderas</button>
        </div>
    </div>

    <!-- Grid de Ropa Dinámico (MongoDB) -->
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        
        <!-- BUCLE DE PRODUCTOS REALES DESDE MONGODB -->
        @forelse($productos as $prod)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden bg-white evaluation-card transition-all">
                    <!-- Contenedor de la Imagen Física -->
                    <div class="ratio ratio-1x1 bg-light d-flex align-items-center justify-content-center overflow-hidden" style="max-height: 240px;">
                        <img src="{{ asset($prod->imagen_path ?? 'uploads/products/default.jpg') }}" class="card-img-top object-fit-cover w-100 h-100" alt="{{ $prod->nombre }}">
                    </div>
                    
                    <!-- Cuerpo de la Tarjeta con Formulario de Compra -->
                    <div class="card-body d-flex flex-column p-4">
                        <span class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 0.65rem;">{{ $prod->categoria ?? 'Prenda' }}</span>
                        <h5 class="card-title fw-bold text-dark mt-1 mb-2 fs-6 text-truncate" title="{{ $prod->nombre }}">{{ $prod->nombre }}</h5>
                        <p class="fw-black text-dark fs-5 mb-3">${{ number_format($prod->precio, 2) }}</p>
                        
                        <!-- Formulario seguro acoplado al backend NoSQL -->
                        <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto">
                            @csrf
                            <!-- Pasamos el ID único del documento (_id) -->
                            <input type="hidden" name="producto_id" value="{{ $prod->_id ?? $prod->id ?? $prod['_id'] ?? '' }}">

                            
                            <!-- Selector de Tallas Premium -->
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-bold text-uppercase mb-1" style="font-size: 0.62rem; letter-spacing: 0.5px;">Seleccionar Talla</label>
                                <select name="talla" class="form-select bg-light border-0 py-2 text-dark font-medium small" required style="box-shadow: none; border-radius: 8px; font-size: 0.8rem;">
                                    <option value="S">S</option>
                                    <option value="M" selected>M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-dark bg-black text-white w-100 py-2.5 rounded-3 fw-bold text-uppercase tracking-wider border-0 shadow-sm" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                Agregar a la bolsa ➔
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <!-- MUESTRA ESTO SI NO HAS AGREGADO NADA EN TU PANEL DE CONTROL TODAVÍA -->
            <div class="col-12 text-center py-5 border border-dashed rounded-4 bg-white shadow-sm" style="border-style: dashed !important; border-color: #dee2e6 !important;">
                <div class="fs-1 mb-2">👕</div>
                <h4 class="fw-bold text-dark" style="font-size: 1.1rem;">No hay prendas disponibles</h4>
                <p class="text-muted small m-0">Ve al panel de administración para añadir productos al catálogo actual.</p>
            </div>
        @endforelse

    </div>
</main>


        <footer class="bg-white border-top py-4 text-center text-muted small mt-5">
            
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
