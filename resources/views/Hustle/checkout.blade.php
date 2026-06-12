@extends('layouts.app')

@section('title', 'Checkout — HUSTLE HOUSE')

@section('content')
<div class="max-w-5xl mx-auto px-4 lg:px-8 py-12 w-full">
    <div class="mb-8">
        <h1 class="font-display text-3xl uppercase text-paper">Finalizar Pedido</h1>
        <p class="text-steel text-sm mt-1">Completa tus datos para recibir tu pedido.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <div class="lg:col-span-3">
            <form action="{{ route('checkout.procesar') }}" method="POST" class="bg-white/5 rounded-soft p-6 space-y-5" id="checkoutForm">
                @csrf
                <h2 class="font-bold text-paper text-sm uppercase tracking-wider pb-3 border-b border-white/10">Datos de Envío</h2>

                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nombre Completo</label>
                    <input type="text" name="nombre" value="{{ old('nombre', auth()->user()->nombre ?? '') }}" required
                           class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Teléfono (con código de país)</label>
                    <input type="tel" name="telefono" value="{{ old('telefono') }}" placeholder="+52 55 1234 5678" required
                           class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all">
                </div>

                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Dirección de Envío</label>
                    <textarea name="direccion" rows="3" required
                              class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all resize-none"
                              placeholder="Calle, número, colonia, ciudad, código postal">{{ old('direccion') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Notas (opcional)</label>
                    <textarea name="notas" rows="2"
                              class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all resize-none"
                              placeholder="Ej: Llamar antes de entregar, referencia, etc.">{{ old('notas') }}</textarea>
                </div>

                <button type="submit" id="submitBtn"
                        class="w-full py-3.5 bg-rust text-paper font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust-deep transition-all duration-200 cursor-pointer flex items-center justify-center gap-2">
                    <span>Confirmar Pedido por WhatsApp</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                </button>
            </form>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white/5 rounded-soft p-6 sticky top-24">
                <h2 class="font-bold text-paper text-sm uppercase tracking-wider pb-3 border-b border-white/10 mb-4">Resumen del Pedido</h2>

                <div class="space-y-3 mb-6">
                    @foreach($carrito as $id => $item)
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 shrink-0 bg-concrete/5 rounded-soft overflow-hidden">
                                <img src="{{ asset($item['imagen_path'] ?? 'uploads/products/default.jpg') }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-paper text-sm truncate">{{ $item['nombre'] }}</p>
                                <p class="text-steel text-xs">{{ $item['talla'] ?? 'M' }} x {{ $item['cantidad'] }}</p>
                            </div>
                            <p class="font-semibold text-paper text-sm shrink-0">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-white/10 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-steel">Subtotal</span>
                        <span class="text-paper">${{ number_format($totalEstimado, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-steel">Envío</span>
                        <span class="text-rust font-semibold text-xs uppercase tracking-wider">Gratis</span>
                    </div>
                    <div class="flex justify-between text-base font-bold pt-2 border-t border-white/10">
                        <span class="text-paper">Total</span>
                        <span class="text-paper">${{ number_format($totalEstimado, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('checkoutForm')?.addEventListener('submit', function(e) {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg> Procesando...';
});
</script>
@endsection