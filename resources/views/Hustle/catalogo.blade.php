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
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>
        <main class="container my-5">
            <!-- Título y Filtros -->
            <div class="d-md-flex justify-content-between align-items-center mb-5">
                <div>
                    <h1 class="fw-black text-uppercase tracking-tight m-0">Catálogo de Ropa</h1>
                    <p class="text-muted small m-0">Drop 01 — El arte de mantener el ritmo urbano.</p>
                </div>
                <div class="d-flex gap-2 mt-3 mt-md-0">
                    <button class="btn btn-sm btn-dark rounded-pill px-3">Todos</button>
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Playeras</button>
                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3">Sudaderas</button>
                </div>
            </div>

            <!-- Grid de Ropa -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                <!-- Tarjeta de Producto 1 -->
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white">
                        <div class="ratio ratio-1x1 bg-light">
                            <img src="imagenes/Over-1.webp" class="card-img-top object-fit-cover" alt="Playera Hustle" style="height: 180px;">
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <span class="text-uppercase text-muted fw-bold small tracking-wider" style="font-size: 0.75rem;">Playeras</span>
                            <h5 class="card-title fw-bold text-dark mt-1 mb-2 fs-6 text-truncate">Playera Oversize "Hustle"</h5>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                                <span class="fw-bold text-dark fs-5">$39.99</span>
                                <a href="#" class="btn btn-sm btn-black text-white bg-black px-3 rounded-pill">Ver más</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tarjeta de Producto 2 -->
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card bg-white">
                        <div class="ratio ratio-1x1 bg-light">
                            <img src="imagenes/hodd-1.jpg" class="card-img-top object-fit-cover" alt="Hoodie House" style="height: 150px;">
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <span class="text-uppercase text-muted fw-bold small tracking-wider" style="font-size: 0.75rem;">Sudaderas</span>
                            <h5 class="card-title fw-bold text-dark mt-1 mb-2 fs-6 text-truncate">Hoodie Minimalist "House"</h5>
                            <div class="d-flex justify-content-between align-items-center mt-auto pt-2">
                                <span class="fw-bold text-dark fs-5">$59.99</span>
                                <a href="#" class="btn btn-sm btn-black text-white bg-black px-3 rounded-pill">Ver más</a>
                            </div>
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
