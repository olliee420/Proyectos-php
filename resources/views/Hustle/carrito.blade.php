@extends('layouts.app')

@section('title', 'Carrito — HUSTLE HOUSE')

@section('content')
<div class="max-w-7xl mx-auto px-4 lg:px-8 py-12 w-full">
    @if(isset($carrito) && count($carrito) > 0)
        <div class="mb-8">
            <h1 class="font-display text-3xl uppercase text-paper">Bolsa de Compra</h1>
            <p class="text-steel text-sm mt-1">Tienes <span class="text-paper font-semibold">{{ count($carrito) }} {{ count($carrito) == 1 ? 'artículo' : 'artículos' }}</span> en tu carrito.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @foreach($carrito as $id => $item)
                    <div class="flex flex-wrap items-center gap-3 p-3 sm:p-4 bg-white/5 rounded-soft">
                        <div class="w-14 h-14 sm:w-16 sm:h-16 shrink-0 bg-concrete/5 rounded-soft overflow-hidden">
                            <img src="{{ asset($item['imagen_path'] ?? 'uploads/products/default.jpg') }}" alt="{{ $item['nombre'] }}" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0 order-3 sm:order-none w-full sm:w-auto mt-2 sm:mt-0">
                            <span class="text-steel text-xs uppercase tracking-widest font-medium">{{ $item['categoria'] ?? 'Prenda' }}</span>
                            <h3 class="font-semibold text-paper text-sm truncate">{{ $item['nombre'] }}</h3>
                            <p class="text-steel text-xs">Talla: <span class="text-paper">{{ $item['talla'] ?? 'M' }}</span></p>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 rounded-full px-2 py-1">
                            <form action="{{ route('carrito.actualizar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="key" value="{{ $id }}">
                                <input type="hidden" name="accion" value="decrementar">
                                <button type="submit" class="w-7 h-7 flex items-center justify-center rounded-full bg-paper/10 text-paper text-sm hover:bg-paper/20 transition-colors cursor-pointer">&minus;</button>
                            </form>
                            <span class="text-paper font-semibold text-sm w-6 text-center">{{ $item['cantidad'] }}</span>
                            <form action="{{ route('carrito.actualizar') }}" method="POST">
                                @csrf
                                <input type="hidden" name="key" value="{{ $id }}">
                                <input type="hidden" name="accion" value="incrementar">
                                <button type="submit" class="w-7 h-7 flex items-center justify-center rounded-full bg-paper/10 text-paper text-sm hover:bg-paper/20 transition-colors cursor-pointer">&plus;</button>
                            </form>
                        </div>
                        <div class="text-right shrink-0 ml-auto">
                            <p class="font-bold text-paper text-sm sm:text-base">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</p>
                            <form action="{{ route('carrito.eliminar') }}" method="POST" onsubmit="return confirm('¿Remover este artículo?')">
                                @csrf
                                <input type="hidden" name="key" value="{{ $id }}">
                                <button type="submit" class="text-xs text-steel hover:text-red-400 transition-colors cursor-pointer">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <a href="{{ route('catalogo') }}" class="inline-flex items-center gap-1 text-sm text-steel hover:text-paper transition-colors mt-4">
                    &larr; Continuar comprando
                </a>
            </div>

            <div class="bg-white/5 rounded-soft p-6 h-fit">
                <h3 class="font-bold text-paper text-sm uppercase tracking-wider mb-6">Resumen de Orden</h3>
                <div class="space-y-3 pb-6 border-b border-white/10 mb-6">
                    <div class="flex justify-between text-sm">
                        <span class="text-steel">Subtotal</span>
                        <span class="text-paper font-semibold">${{ number_format($totalEstimado ?? 0, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-steel">Envío estimado</span>
                        <span class="text-rust font-semibold text-xs uppercase tracking-wider">Gratis</span>
                    </div>
                    <div class="flex gap-2 pt-2">
                        <input type="text" placeholder="Código de descuento" class="flex-1 bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-3 py-2 text-xs outline-none focus:ring-2 focus:ring-rust/30">
                        <button class="px-4 py-2 bg-paper text-ink text-xs font-semibold rounded-soft hover:bg-rust hover:text-paper transition-colors cursor-pointer">Aplicar</button>
                    </div>
                </div>
                <div class="flex justify-between items-center mb-6">
                    <span class="font-semibold text-paper text-sm">Total estimado</span>
                    <span class="font-bold text-paper text-xl">${{ number_format($totalEstimado ?? 0, 2) }}</span>
                </div>
                <a href="{{ route('checkout') }}" class="block w-full py-3.5 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200 text-center">
                    Proceder al Pago &rarr;
                </a>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <span class="text-5xl block mb-4">🛒</span>
            <h2 class="font-display text-3xl uppercase text-paper">Tu bolsa está vacía</h2>
            <p class="text-steel text-sm mt-2 max-w-xs mx-auto">No has agregado ninguna prenda del drop a tu bolsa de compras todavía.</p>
            <a href="{{ route('catalogo') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200">
                Ver Drop Actual
            </a>
        </div>
    @endif
</div>
@endsection