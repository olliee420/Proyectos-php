<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-transparent text-paper font-semibold text-sm uppercase tracking-wider rounded-full border border-white/20 hover:bg-white/10 transition-colors duration-200 cursor-pointer']) }}>
    {{ $slot }}
</button>