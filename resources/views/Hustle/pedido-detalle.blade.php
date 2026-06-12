@extends('layouts.app')

@section('title', 'Pedido #'.$pedido->_id.' — HUSTLE HOUSE')

@section('content')
<div class="max-w-4xl mx-auto px-4 lg:px-8 py-12 w-full">
    <a href="{{ route('pedidos') }}" class="inline-flex items-center gap-1 text-sm text-steel hover:text-paper transition-colors mb-6">&larr; Mis Pedidos</a>

    @php $p = (array)$pedido; @endphp

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-display text-3xl uppercase text-paper">Pedido #{{ $p['_id'] }}</h1>
            <p class="text-steel text-sm mt-1">
                {{ isset($p['fecha_creacion']) ? \Carbon\Carbon::parse($p['fecha_creacion'])->format('d M, Y \\a \\l\\a\\s h:i A') : 'Sin fecha' }}
            </p>
        </div>
        <div>
            @if(($p['estado'] ?? '') === 'Entregado')
                <span class="inline-block px-4 py-1.5 bg-rust/20 text-rust text-xs font-semibold uppercase tracking-wider rounded-full">✅ Entregado</span>
            @elseif(($p['estado'] ?? '') === 'Cancelado')
                <span class="inline-block px-4 py-1.5 bg-red-500/10 text-red-400 text-xs font-semibold uppercase tracking-wider rounded-full">❌ Cancelado</span>
            @else
                <span class="inline-block px-4 py-1.5 bg-white/10 text-steel text-xs font-semibold uppercase tracking-wider rounded-full">🕐 {{ $p['estado'] ?? 'Pendiente' }}</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white/5 rounded-soft p-6">
                <h2 class="font-bold text-paper text-sm uppercase tracking-wider pb-3 border-b border-white/10 mb-4">Productos</h2>
                <div class="space-y-3">
                    @foreach($p['items'] ?? [] as $item)
                        @php $item = (array)$item; @endphp
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-paper text-sm">{{ $item['nombre'] ?? 'Prenda' }}</p>
                                <p class="text-steel text-xs">{{ $item['talla'] ?? 'Única' }} x {{ $item['cantidad'] ?? 1 }}</p>
                            </div>
                            <p class="font-semibold text-paper text-sm">${{ number_format($item['subtotal'] ?? $item['precio'] ?? 0, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white/5 rounded-soft p-6">
                <h2 class="font-bold text-paper text-sm uppercase tracking-wider pb-3 border-b border-white/10 mb-4">Dirección de Envío</h2>
                <p class="text-paper text-sm">{{ $p['cliente_nombre'] ?? '' }}</p>
                <p class="text-steel text-sm">+503 {{ $p['cliente_telefono'] ?? '' }}</p>
                <p class="text-steel text-sm mt-2">{{ $p['direccion'] ?? '' }}</p>
                @if($p['notas'] ?? false)
                    <p class="text-steel text-sm mt-3 italic">📝 {{ $p['notas'] }}</p>
                @endif
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white/5 rounded-soft p-6">
                <h2 class="font-bold text-paper text-sm uppercase tracking-wider pb-3 border-b border-white/10 mb-4">Resumen</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-steel">Subtotal</span>
                        <span class="text-paper">${{ number_format(($p['total'] ?? 0) + ($p['descuento'] ?? 0), 2) }}</span>
                    </div>
                    @if(($p['descuento'] ?? 0) > 0)
                    <div class="flex justify-between">
                        <span class="text-rust text-xs uppercase tracking-wider font-semibold">Descuento {{ $p['codigo_descuento'] ?? '' }}</span>
                        <span class="text-rust font-semibold">-${{ number_format($p['descuento'], 2) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span class="text-steel">Envío</span>
                        <span class="text-rust font-semibold text-xs uppercase tracking-wider">Gratis</span>
                    </div>
                    <div class="flex justify-between font-bold pt-2 border-t border-white/10">
                        <span class="text-paper">Total</span>
                        <span class="text-paper">${{ number_format($p['total'] ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endSection