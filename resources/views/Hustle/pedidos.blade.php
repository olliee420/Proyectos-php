@extends('layouts.app')

@section('title', 'Mis Pedidos — HUSTLE HOUSE')

@section('content')
<div class="max-w-4xl mx-auto px-4 lg:px-8 py-12 w-full">
    <div class="mb-8">
        <h1 class="font-display text-3xl uppercase text-paper">Historial de Pedidos</h1>
        <p class="text-steel text-sm mt-1">Revisa el estado de tus drops y compras anteriores.</p>
    </div>

    <div class="space-y-4">
        @forelse($pedidos as $pedido)
            @php $p = (array)$pedido; $primerItem = ($p['items'][0] ?? []); if(is_object($primerItem)) $primerItem = (array)$primerItem; @endphp
            <div class="bg-white/5 rounded-soft overflow-hidden">
                <div class="bg-ink border-b border-white/5 p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div class="flex flex-wrap gap-6 text-sm">
                        <div>
                            <span class="text-steel text-xs uppercase tracking-wider block">Pedido</span>
                            <span class="text-paper font-medium">{{ isset($p['fecha_creacion']) ? \Carbon\Carbon::parse($p['fecha_creacion'])->format('d M, Y') : 'Sin fecha' }}</span>
                        </div>
                        <div>
                            <span class="text-steel text-xs uppercase tracking-wider block">Total</span>
                            <span class="text-paper font-semibold">${{ number_format($p['total'] ?? 0, 2) }}</span>
                        </div>
                        <div>
                            <span class="text-steel text-xs uppercase tracking-wider block">Productos</span>
                            <span class="text-paper font-medium text-xs">{{ count($p['items'] ?? []) }} {{ count($p['items'] ?? []) == 1 ? 'prenda' : 'prendas' }}</span>
                        </div>
                    </div>
                    <div>
                        @if(($p['estado'] ?? '') === 'Entregado')
                            <span class="inline-block px-3 py-1 bg-rust/20 text-rust text-xs font-semibold uppercase tracking-wider rounded-full">✅ Entregado</span>
                        @elseif(($p['estado'] ?? '') === 'Cancelado')
                            <span class="inline-block px-3 py-1 bg-red-500/10 text-red-400 text-xs font-semibold uppercase tracking-wider rounded-full">❌ Cancelado</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-white/10 text-steel text-xs font-semibold uppercase tracking-wider rounded-full">🕐 {{ $p['estado'] ?? 'Pendiente' }}</span>
                        @endif
                    </div>
                </div>

                <div class="p-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 shrink-0 bg-concrete/5 rounded-soft overflow-hidden flex items-center justify-center text-lg">
                            👕
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-semibold text-paper text-sm truncate">{{ $primerItem['nombre'] ?? 'Prenda' }}{{ count($p['items'] ?? []) > 1 ? ' + '.(count($p['items']) - 1).' más' : '' }}</h4>
                            <span class="text-steel text-xs">Pedido #{{ $p['_id'] ?? $p['id'] ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <span class="font-semibold text-paper text-sm shrink-0">${{ number_format($p['total'] ?? 0, 2) }}</span>
                </div>

                <div class="px-4 pb-4 flex justify-end gap-2">
                    <a href="{{ route('pedidos.detalle', $p['_id'] ?? $p['id']) }}" class="px-4 py-2 border border-white/10 text-paper text-xs font-semibold uppercase tracking-wider rounded-full hover:bg-white/10 transition-colors">Ver Detalle</a>
                    @if(($p['estado'] ?? '') === 'Cancelado')
                        <a href="{{ route('catalogo') }}" class="px-4 py-2 bg-paper text-ink text-xs font-semibold uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-colors">Comprar de Nuevo</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-20">
                <span class="text-4xl block mb-4">📦</span>
                <h3 class="font-display text-2xl uppercase text-paper">Aún no has hecho ningún pedido</h3>
                <p class="text-steel text-sm mt-2 max-w-xs mx-auto">Tus compras de los drops exclusivos aparecerán aquí.</p>
                <a href="{{ route('catalogo') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200">
                    Explorar Drop Actual
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection