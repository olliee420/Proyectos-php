<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 px-6 py-3 bg-ink text-paper font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust transition-colors duration-200 cursor-pointer']) }}>
    {{ $slot }}
</button>