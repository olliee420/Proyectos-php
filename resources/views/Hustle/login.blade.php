@extends('layouts.app')

@section('title', 'Entrar — HUSTLE HOUSE')

@section('content')
<div class="min-h-[calc(100vh-4rem)] flex items-center justify-center px-4 py-8">
    <div class="w-full max-w-5xl grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
        <div class="hidden lg:flex flex-col items-center justify-center animate-fade-in">
            <div class="w-72 h-72 text-rust/80">
                <img src="{{ asset('img/logo-detailed.svg') }}" alt="Hustle House" class="w-full h-full">
            </div>
            <span class="font-display text-5xl uppercase text-paper/10 -mt-8 tracking-[0.3em]">Hustle House</span>
        </div>

        <div class="max-w-md mx-auto w-full">
            <div class="text-center mb-8 lg:hidden">
                <div class="w-16 h-16 mx-auto mb-4 animate-fade-in">
                    <img src="{{ asset('img/logo-detailed.svg') }}" alt="Hustle House" class="w-full h-full">
                </div>
            </div>
            <h1 class="font-display text-4xl uppercase text-paper animate-fade-in text-center lg:text-left" style="animation-delay: 150ms; animation-fill-mode: backwards;">Bienvenido</h1>

            @if ($errors->any())
                <div class="mt-6 mb-6 p-3 bg-red-500/10 border border-red-500/20 rounded-soft text-red-400 text-sm animate-fade-in" style="animation-delay: 200ms; animation-fill-mode: backwards;">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="loginForm" class="mt-8 animate-fade-in" style="animation-delay: 250ms; animation-fill-mode: backwards;">
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-steel mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="tu@email.com" required
                               class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all">
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="text-sm font-medium text-steel">Contraseña</label>
                            <a href="#" class="text-xs text-steel hover:text-paper transition-colors">¿Olvidaste?</a>
                        </div>
                        <div class="relative">
                            <input type="password" id="loginPassword" name="password" placeholder="••••••••" required
                                   class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all pr-12">
                            <button type="button" onclick="togglePassword('loginPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-steel hover:text-paper text-sm cursor-pointer">👁️</button>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200">
                        Entrar a la Casa
                    </button>
                </form>

                <p class="text-center text-steel text-sm mt-6">
                    ¿No tienes cuenta?
                    <button onclick="toggleAuth('register')" class="text-paper font-semibold hover:text-rust transition-colors cursor-pointer">Registrarse</button>
                </p>
            </div>

            <div id="registerForm" class="hidden mt-8 animate-fade-in" style="animation-delay: 250ms; animation-fill-mode: backwards;">
                <form action="{{ route('registro.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-steel mb-1.5">Nombre Completo</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Tu Nombre" required
                               class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-steel mb-1.5">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nombre@ejemplo.com" required
                               class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-steel mb-1.5">Contraseña</label>
                            <div class="relative">
                                <input type="password" id="registerPassword" name="password" placeholder="••••••••" required
                                       class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all pr-10">
                                <button type="button" onclick="togglePassword('registerPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-steel hover:text-paper text-sm cursor-pointer">👁️</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-steel mb-1.5">Confirmar</label>
                            <div class="relative">
                                <input type="password" id="confirmPassword" name="password_confirmation" placeholder="••••••••" required
                                       class="w-full bg-white/5 border border-white/10 text-paper placeholder-steel rounded-soft px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-rust/30 focus:border-rust/50 transition-all pr-10">
                                <button type="button" onclick="togglePassword('confirmPassword', this)" class="absolute right-3 top-1/2 -translate-y-1/2 text-steel hover:text-paper text-sm cursor-pointer">👁️</button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3.5 bg-paper text-ink font-semibold text-sm uppercase tracking-wider rounded-full hover:bg-rust hover:text-paper transition-all duration-200">
                        Registrarse Ahora
                    </button>
                </form>

                <p class="text-center text-steel text-sm mt-6">
                    ¿Ya formas parte?
                    <button onclick="toggleAuth('login')" class="text-paper font-semibold hover:text-rust transition-colors cursor-pointer">&larr; Volver al Login</button>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
function toggleAuth(view) {
    document.getElementById('loginForm').classList.toggle('hidden', view !== 'login');
    document.getElementById('registerForm').classList.toggle('hidden', view !== 'register');
}
function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    input.type = input.type === 'password' ? 'text' : 'password';
    btn.innerHTML = input.type === 'password' ? '👁️' : '🙈';
}
</script>
@endsection