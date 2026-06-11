<!doctype html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'HUSTLE HOUSE')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body class="bg-ink text-paper font-sans antialiased min-h-screen flex flex-col">
    <header>
        @include('Hustle.menu')
    </header>
    <main class="flex-1">
        @yield('content')
    </main>
    <footer class="border-t border-white/5 py-8 text-center relative overflow-hidden">
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.02] pointer-events-none">
            <img src="{{ asset('img/logo-detailed.svg') }}" alt="" class="h-32 w-auto">
        </div>
        <div class="relative z-10 flex flex-col items-center gap-2">
            <div class="w-6 h-6 text-steel/40">
                <img src="{{ asset('img/logo-cat.svg') }}" alt="" class="w-full h-full">
            </div>
            <p class="text-steel/60 text-sm">&copy; {{ date('Y') }} HUSTLE HOUSE. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>