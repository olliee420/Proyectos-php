<nav class="navbar navbar-expand-lg bg-black navbar-dark py-3 shadow-sm">
  <div class="container">
    
    <!-- BRAND (Izquierda) -->
    <a class="navbar-brand fw-black tracking-wider text-white fs-4" href="{{ route('welcome') }}">
        HUSTLE<span class="text-secondary">HOUSE</span>
    </a>

    <!-- Botón Móvil -->
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHustle" aria-controls="navbarHustle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Contenido colapsable -->
    <div class="collapse navbar-collapse" id="navbarHustle">
      
      <!-- SEARCH BAR (Centrado en pantallas grandes) -->
      <form class="d-flex mx-auto my-3 my-lg-0 w-100 max-w-md" role="search" action="#" method="GET">
        <div class="input-group">
            <input class="form-control bg-dark border-secondary text-white placeholder-secondary" type="search" placeholder="Buscar prendas o colecciones..." aria-label="Buscar" required />
            <button class="btn btn-outline-light border-secondary" type="submit">
                🔍
            </button>
        </div>
      </form>

      <!-- ACCIONES DE DERECHA -->
      <ul class="navbar-nav ms-auto align-items-lg-center gap-2">
        
        <!-- Catálogo Público / Autenticado -->
        <li class="nav-item">
          <a class="nav-link text-white-50 hover-light" href="{{ route('catalogo') }}">Catálogo</a>
        </li>
        
        <!-- CONFIGURACIÓN DE VISTAS SEGÚN EL ROL DE SESIÓN -->
        @if(session()->has('usuario_autenticado'))
          
          <!-- ZONA EXCLUSIVA CLIENTES -->
          @if(session('usuario_rol') === 'cliente')
            <!-- Mis Pedidos -->
            <li class="nav-item">
              <a class="nav-link text-white-50 hover-light" href="{{ route('pedidos') }}">Mis Pedidos</a>
            </li>

            <!-- CARRITO DE COMPRAS -->
            <li class="nav-item ms-lg-2 me-lg-2">
              <a class="btn btn-light position-relative d-inline-flex align-items-center gap-2 font-monospace px-3" href="{{ route('carrito') }}">
                🛍️ 
                <span class="fw-bold">Carrito</span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  2
                </span>
              </a>
            </li>
          @endif

          <!-- ZONA EXCLUSIVA ADMIN -->
          @if(session('usuario_rol') === 'admin')
            <li class="nav-item">
              <a class="nav-link text-warning fw-bold hover-light" href="{{ route('admin.historial') }}">🛠️ Panel Admin</a>
            </li>
          @endif

          <!-- PERFIL DINÁMICO (Usuario Registrado) -->
          <li class="nav-item">
            <a class="nav-link text-white fw-bold bg-secondary bg-opacity-25 px-3 rounded-pill" href="{{ route('perfil') }}">
                Mi Perfil ({{ session('usuario_nombre') }})
            </a>
          </li>
          
          <!-- Botón de Logout -->
          <li class="nav-item">
            <a class="nav-link text-danger small hover-light" href="{{ route('logout') }}">
                Salir
            </a>
          </li>

        @else
          <!-- Estado: Invitado -->
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="{{ route('login') }}">Login</a>
          </li>
        @endif

      </ul>

    </div>
  </div>
</nav>

<!-- Estilos rápidos para mejorar la interacción visual urbana -->
<style>
    .max-w-md { max-width: 450px; }
    .hover-light:hover { color: #fff !important; transition: color 0.2s ease; }
    .placeholder-secondary::placeholder { color: #6c757d !important; opacity: 1; }
    .fw-black { font-weight: 900; }
</style>
