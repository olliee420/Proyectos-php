@extends('layouts.app')

@section('title', 'Panel Admin — HUSTLE HOUSE')

@section('content')
<div class="max-w-7xl mx-auto px-4 lg:px-8 py-12 w-full">
    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-10 pb-6 border-b border-white/5">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <h1 class="font-display text-3xl uppercase text-paper">Hustle House Control Panel</h1>
                <span class="px-2.5 py-1 bg-rust/20 text-rust text-xs font-bold uppercase tracking-wider rounded-full">Root</span>
            </div>
            <p class="text-steel text-sm">Portal de administración para gestión de productos, inventario y cuentas de usuarios.</p>
        </div>
        <div class="flex items-center gap-2 px-4 py-2 bg-white/5 rounded-soft shrink-0">
            <span class="relative flex w-2 h-2">
                <span class="absolute inline-flex w-full h-full rounded-full bg-rust opacity-75 animate-ping"></span>
                <span class="relative inline-flex w-2 h-2 rounded-full bg-rust"></span>
            </span>
            <div class="text-xs">
                <span class="block text-rust font-semibold uppercase tracking-wider">Modo Admin Activo</span>
                <span class="text-steel font-mono">Administrador Autenticado</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-3 bg-rust/10 border border-rust/20 rounded-soft text-rust text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-3 bg-red-500/10 border border-red-500/20 rounded-soft text-red-400 text-sm">{{ session('error') }}</div>
    @endif

    <div class="mb-6 bg-white/5 rounded-soft p-4 flex flex-col sm:flex-row sm:items-center gap-3">
        <div class="flex items-center gap-2 shrink-0">
            <span class="text-lg">💬</span>
            <span class="text-xs font-medium text-steel uppercase tracking-wider">WhatsApp Admin</span>
        </div>
        <form action="{{ route('admin.whatsapp.update') }}" method="POST" class="flex-1 flex gap-2">
            @csrf
            <input type="text" name="whatsapp" value="{{ $whatsapp ?? '521234567890' }}"
                   class="flex-1 bg-white/5 border border-white/10 text-paper rounded-soft px-3 py-2 text-sm font-mono outline-none focus:ring-2 focus:ring-rust/30"
                   placeholder="521234567890">
            <button type="submit" class="px-4 py-2 bg-rust text-paper text-xs font-semibold uppercase tracking-wider rounded-full hover:bg-rust-deep transition-colors cursor-pointer shrink-0">
                Guardar
            </button>
        </form>
    </div>

    @if(isset($editProducto))
        @php $ep = (array)$editProducto; @endphp
        <div class="mb-10 bg-white/5 rounded-soft p-6 border border-rust/30">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center gap-2">
                    <span class="text-lg">✏️</span>
                    <h2 class="font-bold text-paper text-sm uppercase tracking-wider">Editando: {{ $ep['nombre'] ?? '' }}</h2>
                </div>
                <a href="{{ route('admin.panel') }}" class="text-sm text-steel hover:text-paper transition-colors">&larr; Cancelar</a>
            </div>
            <form action="{{ route('admin.productos.update', $ep['_id'] ?? $ep['id']) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Categoría</label>
                        <select name="categoria" class="w-full bg-ink border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                            <option value="Camisas Oversize" {{ ($ep['categoria']??'') === 'Camisas Oversize' ? 'selected' : '' }}>Camisas Oversize</option>
                            <option value="Hoodies" {{ ($ep['categoria']??'') === 'Hoodies' ? 'selected' : '' }}>Hoodies</option>
                            <option value="Gorras" {{ ($ep['categoria']??'') === 'Gorras' ? 'selected' : '' }}>Gorras</option>
                            <option value="Shorts" {{ ($ep['categoria']??'') === 'Shorts' ? 'selected' : '' }}>Shorts</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">SKU</label>
                        <input type="text" name="sku" value="{{ $ep['sku'] ?? '' }}" class="w-full bg-white/5 border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm font-mono uppercase outline-none focus:ring-2 focus:ring-rust/30" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nombre del Producto</label>
                    <input type="text" name="nombre" value="{{ $ep['nombre'] ?? '' }}" class="w-full bg-ink border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Precio ($)</label>
                        <input type="number" name="precio" step="0.01" value="{{ $ep['precio'] ?? '' }}" class="w-full bg-ink border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Costo ($)</label>
                        <input type="number" name="costo" step="0.01" value="{{ $ep['costo'] ?? '' }}" class="w-full bg-white/5 border border-white/10 text-steel rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nueva Imagen (opcional)</label>
                    <input type="file" name="imagen" accept="image/*" class="w-full bg-white/5 border border-white/10 text-steel rounded-soft px-3 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:bg-paper file:text-ink file:text-xs file:font-semibold hover:file:bg-rust hover:file:text-paper transition-colors">
                </div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="unico" value="0">
                    <input type="checkbox" name="unico" value="1" {{ ($ep['unico'] ?? false) ? 'checked' : '' }} class="w-4 h-4 rounded border-white/10 bg-white/5 text-rust focus:ring-rust/30 cursor-pointer">
                    <span class="text-xs font-medium text-steel uppercase tracking-wider">Producto Único (sin talla ni cantidad)</span>
                </label>
                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.panel') }}" class="px-6 py-2.5 border border-white/10 text-steel text-sm font-semibold rounded-full hover:bg-white/10 transition-colors">Cancelar</a>
                    <button type="submit" class="px-6 py-2.5 bg-rust text-paper text-sm font-semibold uppercase tracking-wider rounded-full hover:bg-rust-deep transition-colors cursor-pointer">Guardar Cambios</button>
                </div>
            </form>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-10">
        <div class="lg:col-span-2">
            <div class="bg-white/5 rounded-soft p-6">
                <div class="flex items-center gap-2 mb-6">
                    <span class="text-lg">👕</span>
                    <h2 class="font-bold text-paper text-sm uppercase tracking-wider">Agregar Prenda al Drop</h2>
                </div>

                <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Categoría</label>
                        <select name="categoria" class="w-full bg-ink border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                            <option value="" selected disabled>Selecciona...</option>
                            <option value="Camisas Oversize">Camisas Oversize</option>
                            <option value="Hoodies">Hoodies</option>
                            <option value="Gorras">Gorras</option>
                            <option value="Shorts">Shorts</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nombre del Producto</label>
                        <input type="text" name="nombre" class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" placeholder="Ej. Hoodie Oversized Hustle" required>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">SKU</label>
                            <input type="text" name="sku" class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-3 py-2.5 text-sm font-mono uppercase outline-none focus:ring-2 focus:ring-rust/30" placeholder="HH-001" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Precio ($)</label>
                            <input type="number" name="precio" step="0.01" class="w-full bg-ink border border-white/10 text-paper rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Costo ($)</label>
                            <input type="number" name="costo" step="0.01" class="w-full bg-white/5 border border-white/10 text-steel rounded-soft px-3 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Subir Imagen</label>
                            <input type="file" name="imagen" accept="image/*" class="w-full bg-white/5 border border-white/10 text-steel rounded-soft px-3 py-2 text-sm file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:bg-paper file:text-ink file:text-xs file:font-semibold hover:file:bg-rust hover:file:text-paper transition-colors" required>
                        </div>
                    </div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="hidden" name="unico" value="0">
                        <input type="checkbox" name="unico" value="1" class="w-4 h-4 rounded border-white/10 bg-white/5 text-rust focus:ring-rust/30 cursor-pointer">
                        <span class="text-xs font-medium text-steel uppercase tracking-wider">Producto Único (sin talla ni cantidad)</span>
                    </label>
                    <button type="submit" class="w-full py-3 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200 cursor-pointer">
                        Publicar Prenda Oficial
                    </button>
                </form>
            </div>
        </div>

        <div class="lg:col-span-3">
            <div class="bg-white/5 rounded-soft p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-2">
                        <span class="text-lg">📦</span>
                        <div>
                            <h2 class="font-bold text-paper text-sm uppercase tracking-wider">Inventario de Productos</h2>
                            <small class="text-steel text-xs">{{ isset($productos) ? count($productos).' prendas en total' : 'Sin datos' }}</small>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto" style="max-height: 420px; overflow-y: auto;">
                    <table class="w-full text-sm">
                        <thead class="sticky top-0 bg-ink z-10">
                            <tr class="border-b border-white/5">
                                <th class="text-left text-xs font-medium text-steel uppercase tracking-wider pb-3 pr-2">Producto</th>
                                <th class="text-left text-xs font-medium text-steel uppercase tracking-wider pb-3 px-2">SKU</th>
                                <th class="text-right text-xs font-medium text-steel uppercase tracking-wider pb-3 px-2">Precio</th>
                                <th class="text-center text-xs font-medium text-steel uppercase tracking-wider pb-3 px-2">Estado</th>
                                <th class="text-center text-xs font-medium text-steel uppercase tracking-wider pb-3 pl-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($productos as $prod)
                                @php $p = (array)$prod; @endphp
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors {{ ($p['vendido'] ?? false) ? 'opacity-40' : '' }}">
                                    <td class="py-3 pr-2">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 shrink-0 bg-concrete/5 rounded overflow-hidden">
                                                <img src="{{ asset($p['imagen_path'] ?? 'uploads/products/default.jpg') }}" alt="" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <span class="block font-medium text-paper text-xs truncate max-w-32">{{ $p['nombre'] ?? '' }}</span>
                                                <span class="text-steel text-xs">{{ $p['categoria'] ?? '' }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-steel text-xs font-mono px-2 py-3">{{ $p['sku'] ?? '' }}</td>
                                    <td class="text-right text-paper font-semibold text-xs px-2 py-3">${{ number_format($p['precio'] ?? 0, 2) }}</td>
                                    <td class="text-center px-2 py-3">
                                        @if($p['vendido'] ?? false)
                                            <span class="inline-block px-2 py-0.5 bg-green-500/10 text-green-400 text-xs font-semibold rounded-full">Vendido</span>
                                        @else
                                            <span class="inline-block px-2 py-0.5 bg-white/10 text-steel text-xs font-semibold rounded-full">Disponible</span>
                                        @endif
                                    </td>
                                    <td class="py-3 pl-2">
                                        <div class="flex items-center justify-center gap-1">
                                            <a href="{{ route('admin.productos.edit', $p['_id'] ?? $p['id']) }}" class="px-2.5 py-1.5 border border-white/10 text-steel text-xs rounded-soft hover:bg-white/10 transition-colors">✏️</a>
                                            <form action="{{ route('admin.productos.vendido', $p['_id'] ?? $p['id']) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-2.5 py-1.5 border border-white/10 text-xs rounded-soft hover:bg-white/10 transition-colors cursor-pointer {{ ($p['vendido'] ?? false) ? 'text-green-400 border-green-500/30' : 'text-steel' }}">💵</button>
                                            </form>
                                            <form action="{{ route('admin.productos.destroy', $p['_id'] ?? $p['id']) }}" method="POST" onsubmit="return confirm('¿Eliminar permanentemente {{ addslashes($p['nombre'] ?? '') }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2.5 py-1.5 border border-red-500/20 text-red-400 text-xs rounded-soft hover:bg-red-500/10 transition-colors cursor-pointer">🗑️</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-12 text-steel">
                                        <span class="text-2xl block mb-2">📦</span>
                                        <p class="text-sm">No hay productos en el inventario.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white/5 rounded-soft p-6">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
            <div class="flex items-center gap-2">
                <span class="text-lg">👥</span>
                <div>
                    <h2 class="font-bold text-paper text-sm uppercase tracking-wider">Usuarios Registrados</h2>
                    <small class="text-steel text-xs">
                        @if(isset($usuarios))
                            {{ count($usuarios) }} {{ count($usuarios) == 1 ? 'usuario registrado' : 'usuarios en total' }}
                        @else
                            Control de cuentas activo
                        @endif
                    </small>
                </div>
            </div>
            <div class="relative w-full sm:w-64">
                <input type="text" id="userSearch" placeholder="Buscar usuario o correo..." class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft pl-9 pr-3 py-2 text-sm outline-none focus:ring-2 focus:ring-rust/30">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-steel text-sm">🔍</span>
            </div>
        </div>
        <div class="overflow-x-auto" style="max-height: 360px; overflow-y: auto;">
            <table class="w-full text-sm" id="userTable">
                <thead class="sticky top-0 bg-ink z-10">
                    <tr class="border-b border-white/5">
                        <th class="text-left text-xs font-medium text-steel uppercase tracking-wider pb-3 pr-4">Usuario / Correo</th>
                        <th class="text-center text-xs font-medium text-steel uppercase tracking-wider pb-3 px-4">Rol</th>
                        <th class="text-left text-xs font-medium text-steel uppercase tracking-wider pb-3 px-4">Registro</th>
                        <th class="text-center text-xs font-medium text-steel uppercase tracking-wider pb-3 pl-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuarios as $usuario)
                        @php $userArr = (array)$usuario; @endphp
                        <tr class="user-row border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-3 pr-4">
                                <span class="block font-medium text-paper search-target">{{ $userArr['nombre'] ?? 'Sin Nombre' }}</span>
                                <small class="text-steel font-mono search-target" style="font-size: 0.7rem;">{{ $userArr['email'] ?? 'sin-correo' }}</small>
                            </td>
                            <td class="text-center py-3 px-4">
                                @if(($userArr['rol'] ?? 'cliente') === 'admin')
                                    <span class="inline-block px-2 py-1 bg-rust/20 text-rust text-xs font-bold rounded-soft">Admin</span>
                                @else
                                    <span class="inline-block px-2 py-1 bg-white/10 text-steel text-xs font-bold rounded-soft">Cliente</span>
                                @endif
                            </td>
                            <td class="text-steel py-3 px-4 text-xs">
                                @if(isset($userArr['fecha_creacion']))
                                    {{ \Carbon\Carbon::parse($userArr['fecha_creacion'])->format('d M Y') }}
                                @else
                                    Sin Fecha
                                @endif
                            </td>
                            <td class="py-3 pl-4">
                                <div class="flex justify-center gap-2">
                                    @if(($userArr['rol'] ?? 'cliente') !== 'admin')
                                        <form action="{{ route('admin.users.destroy', $usuario->_id ?? $userArr['_id'] ?? $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar permanentemente a este cliente?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1.5 border border-red-500/20 text-red-400 text-xs font-medium rounded-soft hover:bg-red-500/10 transition-colors cursor-pointer">❌ Eliminar</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-steel">
                                <span class="text-2xl block mb-2">👥</span>
                                <p class="text-sm">No hay usuarios registrados en la base de datos.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('userSearch')?.addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        document.querySelectorAll('.user-row').forEach(row => {
            row.style.display = row.innerText.toLowerCase().includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection