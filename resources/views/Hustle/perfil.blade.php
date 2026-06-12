@extends('layouts.app')

@section('title', 'Mi Perfil — HUSTLE HOUSE')

@section('content')
<div class="max-w-5xl mx-auto px-4 lg:px-8 py-12 w-full">
    @if(session('success'))
        <div class="mb-6 p-3 bg-rust/10 border border-rust/20 rounded-soft text-rust text-sm">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-3 bg-red-500/10 border border-red-500/20 rounded-soft text-red-400 text-sm">{{ session('error') }}</div>
    @endif

    <div class="mb-8">
        <h1 class="font-display text-3xl uppercase text-paper">Ajustes de Perfil</h1>
        <p class="text-steel text-sm mt-1">Gestiona tu información personal y datos de envío.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="md:col-span-1">
            <div class="bg-white/5 rounded-soft p-6 text-center">
                <div class="w-16 h-16 mx-auto rounded-full bg-rust flex items-center justify-center p-3">
                    <img src="{{ asset('img/logo-cat.svg') }}" alt="" class="w-full h-full" style="filter: brightness(0) invert(1);">
                </div>
                <h3 class="font-semibold text-paper text-sm mt-3">{{ $userData->nombre ?? 'Hustler' }}</h3>
                <span class="text-xs text-steel uppercase tracking-wider block mt-1">{{ $userData->rol ?? 'cliente' }}</span>
                <div class="mt-6 pt-4 border-t border-white/10 space-y-1 text-left">
                    <a href="#" class="block text-sm text-paper font-semibold px-2 py-1.5 rounded-soft bg-white/5">Mi Cuenta</a>
                    <a href="{{ route('pedidos') }}" class="block text-sm text-steel hover:text-paper transition-colors px-2 py-1.5">Mis Pedidos</a>
                    <a href="{{ route('carrito') }}" class="block text-sm text-steel hover:text-paper transition-colors px-2 py-1.5">Mi Carrito</a>
                </div>
            </div>
        </div>

        <div class="md:col-span-3 space-y-6">
            <div class="bg-white/5 rounded-soft p-6">
                <h4 class="font-bold text-paper text-sm uppercase tracking-wider mb-6 pb-3 border-b border-white/10">Información del Perfil</h4>
                <form action="{{ route('perfil.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nombre Completo</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $userData->nombre ?? '') }}"
                                   class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" required>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Teléfono</label>
                            <input type="text" name="telefono" value="{{ old('telefono', $userData->telefono ?? '') }}" placeholder="7555 1234"
                                   class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Dirección de Envío</label>
                        <input type="text" name="direccion" value="{{ old('direccion', $userData->direccion ?? '') }}"
                               class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30"
                               placeholder="Calle, número, colonia, ciudad">
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 bg-paper text-ink font-semibold text-xs uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200 cursor-pointer">Guardar Cambios</button>
                    </div>
                </form>
            </div>

            <div class="bg-white/5 rounded-soft p-6">
                <h4 class="font-bold text-paper text-sm uppercase tracking-wider mb-6 pb-3 border-b border-white/10">Actualizar Contraseña</h4>
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Nueva Contraseña</label>
                            <input type="password" class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" placeholder="Mínimo 8 caracteres">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-steel uppercase tracking-wider mb-1.5">Confirmar Contraseña</label>
                            <input type="password" class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30" placeholder="Repite la nueva">
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" class="px-6 py-2.5 bg-paper text-ink font-semibold text-xs uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200 cursor-pointer">Actualizar Credenciales</button>
                    </div>
                </form>
            </div>

            @if(($userData->rol ?? '') === 'admin')
            <div class="bg-white/5 rounded-soft p-6 border border-rust/20">
                <h4 class="font-bold text-paper text-sm uppercase tracking-wider mb-6 pb-3 border-b border-white/10 flex items-center gap-2">
                    <span>💬</span> WhatsApp de Pedidos
                </h4>
                <form action="{{ route('perfil.whatsapp') }}" method="POST" class="space-y-4">
                    @csrf
                    <p class="text-steel text-xs">Número donde llegarán las notificaciones de pedidos nuevos.</p>
                    <div class="flex gap-2">
                        <input type="text" name="whatsapp" value="{{ $whatsapp ?? '503' }}"
                               class="flex-1 bg-white/5 border border-white/10 text-paper rounded-soft px-4 py-2.5 text-sm font-mono outline-none focus:ring-2 focus:ring-rust/30"
                               placeholder="50375551234">
                        <button type="submit" class="px-6 py-2.5 bg-rust text-paper font-semibold text-xs uppercase tracking-wider rounded-full hover:bg-rust-deep transition-colors cursor-pointer shrink-0">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection