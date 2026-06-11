<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Usuario;


class HustleController extends Controller
{
    public function showLogin() {
        return view('Hustle.login');
    }

    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/perfil');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function registro(Request $request) 
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if (Usuario::where('email', $request->email)->exists()) {
            return back()->withErrors(['email' => 'Este correo electrónico ya está registrado.']);
        }

        $maxId = Usuario::max('_id');
        $nuevoId = ($maxId ? (int)$maxId : 0) + 1;

        $usuario = Usuario::create([
            '_id' => $nuevoId,
            'nombre' => $request->nombre,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'cliente',
            'fecha_creacion' => now(),
        ]);

        Auth::login($usuario);
        $request->session()->regenerate();

        return redirect()->to('/index');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    
    public function showMenu() {
        if (!Auth::check()) return redirect()->route('login');
        return view('Hustle.perfil');
    }

    public function showIndex() {
        if (!Auth::check()) return redirect()->route('login');
        return view('Hustle.index'); 
    }

    public function showPerfil() {
        if (!Auth::check()) return redirect()->route('login');
        return view('Hustle.perfil');
    }

    public function showCatalogo()
    {
        $productos = DB::connection('mongodb')->table('products')->get();
        return view('Hustle.catalogo', compact('productos'));
    }

    // ZONA EXCLUSIVA CLIENTES
    public function showCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $totalEstimado = 0;
        foreach($carrito as $item) {
            $totalEstimado += $item['precio'] * $item['cantidad'];
        }
        return view('Hustle.carrito', compact('carrito', 'totalEstimado'));
    }

    public function agregarAlCarrito(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'talla'       => 'required|string'
        ]);

        $producto = DB::connection('mongodb')->table('products')
            ->where('_id', (int)$request->producto_id)
            ->first();

        if (!$producto) {
            return redirect()->back()->with('error', 'El producto no se encuentra disponible.');
        }

        $producto = (array) $producto;
        $carrito = $request->session()->get('carrito', []);
        $cartKey = $producto['_id'] . '_' . $request->talla;

        if (isset($carrito[$cartKey])) {
            $carrito[$cartKey]['cantidad']++;
        } else {
            $carrito[$cartKey] = [
                'id'          => $producto['_id'],
                'nombre'      => $producto['nombre'],
                'precio'      => (float) $producto['precio'],
                'categoria'   => $producto['categoria'] ?? 'Prenda',
                'imagen_path' => $producto['imagen_path'] ?? 'uploads/products/default.jpg',
                'talla'       => $request->talla,
                'cantidad'    => 1
            ];
        }

        $request->session()->put('carrito', $carrito);
        return redirect()->route('carrito')->with('success', '¡Prenda añadida a tu bolsa con éxito!');
    }

    public function showPedidos(Request $request)
    {
        $usuarioId = Auth::id();
        $pedidos = DB::connection('mongodb')->table('Pedidos')
                    ->where('usuario_id', $usuarioId)
                    ->orderBy('fecha_creacion', 'desc')
                    ->get();
        return view('Hustle.pedidos', compact('pedidos'));
    }

    // ZONA EXCLUSIVA ADMINISTRADORES

    public function showAdminPanel()
    {
        $usuarios = DB::connection('mongodb')->table('usuarios')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
        return view('Hustle.historial', compact('usuarios'));
    }

    public function destroyUser($id)
    {
        $deleted = DB::connection('mongodb')->table('usuarios')
            ->where('id', (int)$id)
            ->delete();
        if (!$deleted) {
            DB::connection('mongodb')->table('usuarios')
                ->where('_id', (int)$id)
                ->delete();
        }
        return redirect()->back()->with('success', 'El usuario ha sido eliminado correctamente de Hustle House.');
    }

    public function showHistorial()
    {
        $usuarios = DB::connection('mongodb')->table('usuarios')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
        return view('Hustle.historial', compact('usuarios'));
    }

    public function storeProducto(Request $request) 
    {
        $request->validate([
            'categoria' => 'required|string',
            'nombre'    => 'required|string|max:255',
            'sku'       => 'required|string',
            'precio'    => 'required|numeric|min:0',
            'costo'     => 'required|numeric|min:0',
            'imagen'    => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $skuExiste = DB::connection('mongodb')->table('products')
            ->where('sku', strtoupper($request->sku))
            ->first();

        if ($skuExiste) {
            return redirect()->back()->withErrors(['sku' => 'El SKU ingresado ya pertenece a otra prenda registrada.'])->withInput();
        }

        $maxId = DB::connection('mongodb')->table('products')->max('_id');
        $ultimoId = $maxId ? (int)$maxId : 0;
        $nuevoId = $ultimoId + 1;

        $rutaImagen = 'uploads/products/default.jpg';

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/products');

            if (!\Illuminate\Support\Facades\File::exists($destinationPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $filename);
            $rutaImagen = 'uploads/products/' . $filename;
        }

        DB::connection('mongodb')->table('products')->insert([
            '_id'            => $nuevoId,
            'categoria'      => $request->categoria,
            'nombre'         => $request->nombre,
            'sku'            => strtoupper($request->sku),
            'precio'         => (float) $request->precio,
            'costo'          => (float) $request->costo,
            'imagen_path'    => $rutaImagen,
            'fecha_creacion' => now()
        ]);

        return redirect()->route('admin.panel')->with('success', '¡Prenda guardada y publicada exitosamente en el drop!');
    }


}
