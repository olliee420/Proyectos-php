<!doctype html>
<html lang="es" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 — HUSTLE HOUSE</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #0a0a0a; color: #fafafa; font-family: 'Space Grotesk', sans-serif; display: flex; align-items: center; justify-content: center; min-height: 100vh; text-align: center; padding: 2rem; }
        .container { max-width: 420px; }
        .logo { width: 80px; height: 80px; margin: 0 auto 2rem; opacity: 0.6; }
        .logo svg { width: 100%; height: 100%; }
        h1 { font-family: 'Archivo Black', sans-serif; font-size: 6rem; line-height: 1; color: #c2410c; text-transform: uppercase; }
        p { color: #888; margin: 1rem 0 2rem; font-size: 0.9rem; }
        a { display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 2rem; background: #fafafa; color: #0a0a0a; border-radius: 9999px; text-decoration: none; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; transition: background 0.2s; }
        a:hover { background: #c2410c; color: #fafafa; }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/logo-detailed.svg') }}" alt="" class="w-full h-full" style="opacity: 0.5;">
        </div>
        <h1>404</h1>
        <p>Esta página no existe o fue movida.<br>Pero el hustle sigue.</p>
        <a href="{{ url('/') }}">Volver al Inicio</a>
    </div>
</body>
</html>