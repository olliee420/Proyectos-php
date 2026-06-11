@props(['producto'])
<div class="group">
    <div class="aspect-square bg-concrete overflow-hidden">
        <img src="{{ asset($producto->imagen_path ?? 'uploads/products/default.jpg') }}"
             alt="{{ $producto->nombre }}"
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
    </div>
    <div class="pt-3 space-y-1">
        <span class="text-steel text-xs uppercase tracking-widest font-medium">{{ $producto->categoria ?? 'Prenda' }}</span>
        <h3 class="font-semibold text-paper text-sm leading-tight truncate">{{ $producto->nombre }}</h3>
        <p class="font-bold text-paper">${{ number_format($producto->precio, 2) }}</p>
    </div>
</div>