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
         <style>
            /* Ajuste para que las imágenes se vean COMPLETAS sin recortes */
            .carousel-item img {
                height: 65vh;
                object-fit: contain;
                background-color: #ffffff; /* Fondo blanco limpio para la ropa */
            }
            body {
                background-color: #f8f9fa;
                font-family: 'Helvetica Neue', Arial, sans-serif;
            }
            .fw-black { font-weight: 900; }
            
            /* Animación suave para las tarjetas de categorías */
            .category-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
            }
            .category-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
            }
        </style>
    </head>

    <body>
        <header>
            <!-- place navbar here -->
             @include('Hustle.menu')
        </header>


        <main class="container my-5">
            <!-- SECCIÓN 1: Carrusel de Productos Limpio y Destacado -->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-10">
                    <div id="carouselHustleHouse" class="carousel slide shadow-sm rounded-4 overflow-hidden" data-bs-ride="carousel">
                        
                        <!-- Indicadores inferiores -->
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselHustleHouse" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselHustleHouse" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselHustleHouse" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>

                        <!-- Fotos completas del Carrusel -->
                        <div class="carousel-inner">
                            <!-- Foto 1 -->
                            <div class="carousel-item active">
                                <img src="{{ asset('imagenes/1_c1eFJH.webp') }}" class="d-block w-100" alt="Camiseta Oversize Negra Frontal">
                                <div class="carousel-caption d-none d-md-block bg-black bg-opacity-75 rounded-4 p-3 mb-3 mx-auto" style="max-width: 80%;">
                                    <h5 class="fw-bold tracking-wide m-0">DROP 01: OVERSIZE TEE</h5>
                                    <p class="small text-white-50 m-0">100% Algodón Premium de 240 gramos.</p>
                                </div>
                            </div>
                            
                            <!-- Foto 2 -->
                            <div class="carousel-item">
                                <img src="{{ asset('imagenes/foto2.jpg') }}" class="d-block w-100" alt="Camiseta Oversize Blanca">
                                <div class="carousel-caption d-none d-md-block bg-black bg-opacity-75 rounded-4 p-3 mb-3 mx-auto" style="max-width: 80%;">
                                    <h5 class="fw-bold tracking-wide m-0">ESTILO URBANO MINIMALISTA</h5>
                                    <p class="small text-white-50 m-0">Diseño holgado hecho para el confort diario.</p>
                                </div>
                            </div>
                            
                            <!-- Foto 3 -->
                            <div class="carousel-item">
                                <img src="{{ asset('imagenes/foto3.avif') }}" class="d-block w-100" alt="Detalle Streetwear">
                                <div class="carousel-caption d-none d-md-block bg-black bg-opacity-75 rounded-4 p-3 mb-3 mx-auto" style="max-width: 80%;">
                                    <h5 class="fw-bold tracking-wide m-0">COLECCIÓN COMPLETA</h5>
                                    <p class="small text-white-50 m-0">Combina tus outfits urbanos con lo último de nuestra casa.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Flechas Laterales de Navegación Estilizadas -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselHustleHouse" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-black p-3 rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Anterior</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselHustleHouse" data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-black p-3 rounded-circle" aria-hidden="true"></span>
                            <span class="visually-hidden">Siguiente</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- SECCIÓN 2: Banner de Introducción / Call To Action -->
            <div class="text-center my-5 py-4">
                <span class="text-muted text-uppercase tracking-widest small d-block mb-2">Drop 01 — El arte de mantener el ritmo urbano.</span>
                <h2 class="fw-black text-uppercase display-5 tracking-tight text-dark">VISTE SIN REGLAS. VIVE CON HUSTLE.</h2>
                <p class="text-secondary col-md-6 mx-auto mb-4">Explora prendas diseñadas con cortes oversize perfectos, materiales pesados de alta durabilidad y estética urbana minimalista.</p>
                <a href="{{ url('/catalogo') }}" class="btn btn-dark bg-black text-white px-5 py-3 rounded-pill fw-bold text-uppercase tracking-wider shadow-sm">
                    Ver Catálogo Completo ➔
                </a>
            </div>

            <hr class="my-5 border-light">

            <!-- SECCIÓN 3: Accesos Rápidos a Categorías -->
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-md-4">
                    <a href="{{ url('/catalogo') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white category-card">
                            <div class="fs-1 mb-2">👕</div>
                            <h6 class="fw-bold text-dark text-uppercase m-0">Playeras</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="{{ url('/catalogo') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white category-card">
                            <div class="fs-1 mb-2">🧥</div>
                            <h6 class="fw-bold text-dark text-uppercase m-0">Sudaderas</h6>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-4">
                    <a href="{{ url('/catalogo') }}" class="text-decoration-none">
                        <div class="card border-0 shadow-sm rounded-4 p-4 text-center bg-white category-card">
                            <div class="fs-1 mb-2">🧢</div>
                            <h6 class="fw-bold text-dark text-uppercase m-0">Accesorios</h6>
                        </div>
                    </a>
                </div>
            </div>
        </main>

        <footer class="bg-white border-top py-4 text-center text-muted small mt-5">
            <p class="mb-0">&copy; {{ date('Y') }} HUSTLE HOUSE. Todos los derechos reservados.</p>
        </footer>

        <script 
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
