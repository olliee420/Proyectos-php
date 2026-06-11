@extends('layouts.app')

@section('title', 'HUSTLE HOUSE — Drop 01')

@section('content')
<div class="relative min-h-screen flex flex-col">
    <section class="relative h-[80vh] sm:h-[90vh] min-h-[500px] sm:min-h-[600px] flex items-end overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-t from-ink via-ink/40 to-transparent z-10"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[60vw] h-[60vw] max-w-[500px] max-h-[500px] text-white/5 z-[1]">
            <img src="{{ asset('img/logo-detailed.svg') }}" alt="" class="w-full h-full opacity-40">
        </div>
        <img src="{{ asset('imagenes/1_c1eFJH.webp') }}" alt="Drop 01" class="absolute inset-0 w-full h-full object-cover">
        <div class="relative z-20 max-w-7xl mx-auto px-4 lg:px-8 pb-16 lg:pb-24 w-full">
            <span class="text-rust font-semibold text-sm uppercase tracking-[0.2em]">Drop 01 — Limitado</span>
            <h1 class="font-display text-5xl sm:text-7xl lg:text-[8rem] leading-[0.85] text-paper mt-2 max-w-4xl uppercase">
                Oversize<br>Tee
            </h1>
            <p class="text-paper/60 text-base mt-4 max-w-md">100% algodón premium de 240 gramos. Corte holgado. Hecho para durar.</p>
            <a href="{{ route('catalogo') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-300">
                Comprar Ahora
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-24 w-full">
        <div class="flex items-center justify-between mb-12">
            <div>
                <span class="text-rust font-semibold text-xs uppercase tracking-[0.2em]">Colección</span>
                <h2 class="font-display text-3xl sm:text-4xl uppercase text-paper mt-1">Drop 01</h2>
            </div>
            <a href="{{ route('catalogo') }}" class="text-sm font-medium text-steel hover:text-paper transition-colors">Ver todo &rarr;</a>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6">
            <div class="aspect-square bg-concrete/5 overflow-hidden group">
                <img src="{{ asset('imagenes/foto2.jpg') }}" alt="Oversize Blanca" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="aspect-square bg-concrete/5 overflow-hidden group">
                <img src="{{ asset('imagenes/foto3.avif') }}" alt="Streetwear" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="aspect-square bg-concrete/5 overflow-hidden group">
                <img src="{{ asset('imagenes/Hodd-1.jpg') }}" alt="Hoodie" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
            <div class="aspect-square bg-concrete/5 overflow-hidden group">
                <img src="{{ asset('imagenes/Over-1.webp') }}" alt="Over" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>
        </div>
    </section>

    <section class="bg-ink border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 lg:px-8 py-24 w-full text-center">
            <span class="text-rust font-semibold text-xs uppercase tracking-[0.2em]">Filosofía</span>
            <h2 class="font-display text-4xl sm:text-5xl uppercase text-paper mt-3 leading-[0.9]">
                Viste sin reglas.<br>Vive con Hustle.
            </h2>
            <p class="text-steel text-base mt-4 max-w-lg mx-auto">Prendas diseñadas con cortes oversize, materiales pesados y estética urbana minimalista. Para los que entienden que el estilo no se pide prestado.</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
                <a href="{{ route('catalogo') }}" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-300">
                    Explorar Catálogo
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </a>
                <a href="#" class="inline-flex items-center justify-center gap-2 w-full sm:w-auto px-6 py-3 border border-white/20 text-paper font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-white/10 transition-all duration-300">
                    Conocer Más
                </a>
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 lg:px-8 py-16 sm:py-24 w-full">
        <div class="grid grid-cols-3 gap-3 sm:gap-4">
            <a href="{{ route('catalogo') }}" class="group flex flex-col items-center justify-center gap-2 sm:gap-3 p-4 sm:p-8 bg-white/5 rounded-soft hover:bg-white/10 transition-colors">
                <span class="text-2xl sm:text-3xl">👕</span>
                <span class="font-semibold text-xs sm:text-sm uppercase tracking-wider text-paper">Playeras</span>
            </a>
            <a href="{{ route('catalogo') }}" class="group flex flex-col items-center justify-center gap-2 sm:gap-3 p-4 sm:p-8 bg-white/5 rounded-soft hover:bg-white/10 transition-colors">
                <span class="text-2xl sm:text-3xl">🧥</span>
                <span class="font-semibold text-xs sm:text-sm uppercase tracking-wider text-paper">Sudaderas</span>
            </a>
            <a href="{{ route('catalogo') }}" class="group flex flex-col items-center justify-center gap-2 sm:gap-3 p-4 sm:p-8 bg-white/5 rounded-soft hover:bg-white/10 transition-colors">
                <span class="text-2xl sm:text-3xl">🧢</span>
                <span class="font-semibold text-xs sm:text-sm uppercase tracking-wider text-paper">Accesorios</span>
            </a>
        </div>
    </section>
</div>
@endsection