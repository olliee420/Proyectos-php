@extends('layouts.app')

@section('title', 'Catálogo — HUSTLE HOUSE')

@section('content')
<div class="max-w-7xl mx-auto px-4 lg:px-8 py-12 w-full">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
        <div>
            <span class="text-rust font-semibold text-xs uppercase tracking-[0.2em]">Drop 01</span>
            <h1 class="font-display text-3xl sm:text-4xl uppercase text-paper mt-1">Catálogo</h1>
            <p class="text-steel text-sm mt-1">El arte de mantener el ritmo urbano.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('catalogo') }}"
               class="px-4 py-2 text-xs font-semibold uppercase tracking-wider rounded-full transition-colors {{ !$categoriaActual ? 'bg-paper text-ink' : 'bg-transparent text-steel border border-white/10 hover:border-white/30' }}">
                Todos
            </a>
            @foreach(['Camisa','Camiseta','Hoodie','Sweater','Chaqueta','Pantalón','Shorts','Pants','Gorra','Calcetines'] as $cat)
                <a href="{{ route('catalogo', ['categoria' => $cat]) }}"
                   class="px-4 py-2 text-xs font-semibold uppercase tracking-wider rounded-full transition-colors {{ $categoriaActual === $cat ? 'bg-paper text-ink' : 'bg-transparent text-steel border border-white/10 hover:border-white/30' }}">
                    {{ $cat }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
        @forelse($productos as $prod)
            <div class="flex flex-col bg-white/5">
                <div class="aspect-square bg-concrete/5 overflow-hidden">
                    <img src="{{ asset($prod->imagen_path ?? 'uploads/products/default.jpg') }}"
                         alt="{{ $prod->nombre }}"
                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                <div class="p-4 flex flex-col flex-1">
                    <span class="text-steel text-xs uppercase tracking-widest font-medium">{{ $prod->categoria ?? 'Prenda' }}</span>
                    <h3 class="font-semibold text-paper text-sm leading-tight truncate mt-1">{{ $prod->nombre }}</h3>
                    <p class="font-bold text-paper text-lg mt-1">${{ number_format($prod->precio, 2) }}</p>

                    @php $esUnico = $prod->unico ?? false; @endphp
                    <form action="{{ route('carrito.agregar') }}" method="POST" class="mt-auto pt-4 space-y-3">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $prod->_id ?? $prod->id ?? $prod['_id'] ?? '' }}">
                        <input type="hidden" name="talla" value="Única">
                        @if(!$esUnico)
                        <select name="talla" class="w-full bg-ink text-paper border border-white/10 rounded-soft px-3 py-2 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                            <option value="S" class="bg-ink text-paper">S</option>
                            <option value="M" selected class="bg-ink text-paper">M</option>
                            <option value="L" class="bg-ink text-paper">L</option>
                            <option value="XL" class="bg-ink text-paper">XL</option>
                        </select>
                        @endif
                        <button type="submit" class="w-full px-4 py-2.5 bg-paper text-ink font-semibold text-xs uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200">
                            {{ $esUnico ? 'Agregar Único' : 'Agregar' }} &rarr;
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-2 lg:col-span-4 text-center py-20">
                <span class="text-4xl block mb-4">👕</span>
                <h3 class="font-display text-2xl uppercase text-paper">{{ $categoriaActual ? 'No hay '.$categoriaActual.'s disponibles' : 'No hay prendas disponibles' }}</h3>
                <p class="text-steel text-sm mt-2">Ve al panel de administración para añadir productos al catálogo.</p>
            </div>
        @endforelse
    </div>
</div>
@endSection