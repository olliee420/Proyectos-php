@props(['placeholder' => 'Buscar...'])
<div class="relative">
    <input {{ $attributes->merge(['type' => 'text', 'class' => 'w-full bg-concrete text-ink placeholder-steel rounded-soft px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:bg-paper transition-all duration-200']) }}
           placeholder="{{ $placeholder }}">
</div>