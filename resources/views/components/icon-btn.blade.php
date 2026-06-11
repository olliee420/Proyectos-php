<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center w-10 h-10 rounded-full bg-concrete text-ink hover:bg-white/20 hover:text-paper transition-colors duration-200 cursor-pointer']) }}>
    {{ $slot }}
</button>