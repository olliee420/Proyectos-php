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
        $usuario = Auth::user();
        $userData = DB::connection('mongodb')->table('usuarios')
            ->where('_id', (int)$usuario->id)
            ->first();
        $whatsapp = $this->getWhatsApp();
        return view('Hustle.perfil', compact('userData', 'whatsapp'));
    }

    public function updatePerfil(Request $request) {
        if (!Auth::check()) return redirect()->route('login');
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'telefono'  => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
        ]);
        $usuario = Auth::user();
        DB::connection('mongodb')->table('usuarios')
            ->where('_id', (int)$usuario->id)
            ->update([
                'nombre'    => $request->nombre,
                'telefono'  => $request->telefono,
                'direccion' => $request->direccion,
            ]);
        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function updatePerfilWhatsApp(Request $request) {
        if (!Auth::check()) return redirect()->route('login');
        $usuario = Auth::user();
        $userArr = (array)DB::connection('mongodb')->table('usuarios')
            ->where('_id', (int)$usuario->id)->first();
        if (($userArr['rol'] ?? '') !== 'admin') {
            return redirect()->route('perfil')->with('error', 'Solo administradores.');
        }
        $request->validate(['whatsapp' => 'required|string|max:20']);
        $telefono = preg_replace('/[^0-9]/', '', $request->whatsapp);
        if (substr($telefono, 0, 3) !== '503') $telefono = '503' . $telefono;
        $exists = DB::connection('mongodb')->table('config')
            ->where('key', 'whatsapp')->first();
        if ($exists) {
            DB::connection('mongodb')->table('config')
                ->where('key', 'whatsapp')->update(['value' => $telefono]);
        } else {
            DB::connection('mongodb')->table('config')
                ->insert(['key' => 'whatsapp', 'value' => $telefono]);
        }
        return redirect()->route('perfil')->with('success', 'WhatsApp actualizado: +' . $telefono);
    }

    public function showCatalogo(Request $request)
    {
        $categoriaActual = $request->query('categoria');
        $query = DB::connection('mongodb')->table('products')
            ->where('vendido', '!=', true);
        if ($categoriaActual) {
            $query->where('categoria', $categoriaActual);
        }
        $productos = $query->get();
        return view('Hustle.catalogo', compact('productos', 'categoriaActual'));
    }

    // ZONA EXCLUSIVA CLIENTES
    public function showCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $descuento = $request->session()->get('descuento');
        $totalEstimado = 0;
        foreach($carrito as $item) {
            $totalEstimado += $item['precio'] * $item['cantidad'];
        }
        $totalFinal = $totalEstimado;
        $descuentoAplicado = 0;
        if ($descuento && $descuento['porcentaje'] > 0) {
            $descuentoAplicado = $totalEstimado * ($descuento['porcentaje'] / 100);
            $totalFinal = $totalEstimado - $descuentoAplicado;
        }
        return view('Hustle.carrito', compact('carrito', 'totalEstimado', 'descuento', 'descuentoAplicado', 'totalFinal'));
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
            $producto = DB::connection('mongodb')->table('products')
                ->where('id', (int)$request->producto_id)
                ->first();
        }

        if (!$producto) {
            return redirect()->back()->with('error', 'El producto no se encuentra disponible.');
        }

        $producto = (array) $producto;
        $productoId = $producto['id'] ?? $producto['_id'] ?? null;
        if (!$productoId) {
            return redirect()->back()->with('error', 'El producto no se encuentra disponible.');
        }

        $esUnico = $producto['unico'] ?? false;
        $carrito = $request->session()->get('carrito', []);
        $cartKey = $productoId . '_' . $request->talla;

        if (isset($carrito[$cartKey])) {
            if ($esUnico) {
                return redirect()->route('carrito')->with('error', 'Producto único — ya está en tu bolsa.');
            }
            $carrito[$cartKey]['cantidad']++;
        } else {
            $carrito[$cartKey] = [
                'id'          => $productoId,
                'nombre'      => $producto['nombre'],
                'precio'      => (float) $producto['precio'],
                'categoria'   => $producto['categoria'] ?? 'Prenda',
                'imagen_path' => $producto['imagen_path'] ?? 'uploads/products/default.jpg',
                'unico'       => $esUnico,
                'talla'       => $request->talla,
                'cantidad'    => 1
            ];
        }

        $request->session()->put('carrito', $carrito);
        return redirect()->route('carrito')->with('success', '¡Prenda añadida a tu bolsa con éxito!');
    }

    public function eliminarDelCarrito(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $key = $request->input('key');
        if ($key && isset($carrito[$key])) {
            unset($carrito[$key]);
            $request->session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito')->with('success', 'Artículo eliminado del carrito.');
    }

    public function actualizarCantidad(Request $request)
    {
        $carrito = $request->session()->get('carrito', []);
        $key = $request->input('key');
        $accion = $request->input('accion');

        if (!in_array($accion, ['incrementar', 'decrementar'], true)) {
            return redirect()->route('carrito');
        }

        if ($key && isset($carrito[$key])) {
            $esUnico = $carrito[$key]['unico'] ?? false;
            if ($accion === 'incrementar') {
                if ($esUnico) {
                    return redirect()->route('carrito')->with('error', 'Producto único — solo 1 unidad.');
                }
                $carrito[$key]['cantidad'] = min(99, $carrito[$key]['cantidad'] + 1);
            } elseif ($accion === 'decrementar') {
                $carrito[$key]['cantidad'] = max(0, $carrito[$key]['cantidad'] - 1);
                if ($carrito[$key]['cantidad'] < 1) {
                    unset($carrito[$key]);
                }
            }
            $request->session()->put('carrito', $carrito);
        }
        return redirect()->route('carrito');
    }

    public function aplicarDescuento(Request $request)
    {
        $codigo = strtoupper(trim($request->input('codigo', '')));
        if ($codigo === '') {
            $request->session()->forget('descuento');
            return redirect()->route('carrito')->with('success', 'Descuento eliminado.');
        }
        if ($codigo === 'HHSANTEIN') {
            $request->session()->put('descuento', ['codigo' => 'HHSANTEIN', 'porcentaje' => 50]);
            return redirect()->route('carrito')->with('success', '🎉 Descuento HHSANTEIN aplicado: 50% OFF!');
        }
        return redirect()->route('carrito')->with('error', 'Código de descuento inválido.');
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
        $productos = DB::connection('mongodb')->table('products')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
        $whatsapp = $this->getWhatsApp();
        return view('Hustle.historial', compact('usuarios', 'productos', 'whatsapp'));
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
            'unico'          => $request->boolean('unico'),
            'fecha_creacion' => now()
        ]);

        return redirect()->route('admin.panel')->with('success', '¡Prenda guardada y publicada exitosamente en el drop!');
    }

    public function editProducto($id)
    {
        $producto = DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->first();
        if (!$producto) {
            return redirect()->route('admin.panel')->with('error', 'Producto no encontrado.');
        }
        return view('Hustle.historial', [
            'editProducto' => $producto,
            'usuarios'    => DB::connection('mongodb')->table('usuarios')->orderBy('fecha_creacion', 'desc')->get(),
            'productos'   => DB::connection('mongodb')->table('products')->orderBy('fecha_creacion', 'desc')->get(),
        ]);
    }

    public function updateProducto(Request $request, $id)
    {
        $request->validate([
            'categoria' => 'required|string',
            'nombre'    => 'required|string|max:255',
            'sku'       => 'required|string',
            'precio'    => 'required|numeric|min:0',
            'costo'     => 'required|numeric|min:0',
            'imagen'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $producto = DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->first();

        if (!$producto) {
            return redirect()->route('admin.panel')->with('error', 'Producto no encontrado.');
        }

        $updateData = [
            'categoria' => $request->categoria,
            'nombre'    => $request->nombre,
            'sku'       => strtoupper($request->sku),
            'precio'    => (float) $request->precio,
            'costo'     => (float) $request->costo,
            'unico'     => $request->boolean('unico'),
        ];

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $destinationPath = public_path('uploads/products');
            if (!\Illuminate\Support\Facades\File::exists($destinationPath)) {
                \Illuminate\Support\Facades\File::makeDirectory($destinationPath, 0755, true, true);
            }
            $file->move($destinationPath, $filename);
            $updateData['imagen_path'] = 'uploads/products/' . $filename;
        }

        DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->update($updateData);

        return redirect()->route('admin.panel')->with('success', 'Prenda actualizada correctamente.');
    }

    public function marcarVendido($id)
    {
        $producto = DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->first();

        if (!$producto) {
            return redirect()->route('admin.panel')->with('error', 'Producto no encontrado.');
        }

        $productoArr = (array)$producto;
        $vendido = !($productoArr['vendido'] ?? false);

        DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->update(['vendido' => $vendido]);

        $msg = $vendido ? 'Prenda marcada como vendida.' : 'Prenda marcada como disponible.';
        return redirect()->route('admin.panel')->with('success', $msg);
    }

    public function destroyProducto($id)
    {
        DB::connection('mongodb')->table('products')
            ->where('_id', (int)$id)
            ->delete();
        return redirect()->route('admin.panel')->with('success', 'Prenda eliminada permanentemente.');
    }

    // ==========================================
    // CHECKOUT + WHATSAPP
    // ==========================================

    private function getWhatsApp()
    {
        $config = DB::connection('mongodb')->table('config')
            ->where('key', 'whatsapp')
            ->first();
        return $config ? $config->value : '521234567890';
    }

    public function showCheckout(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');

        $carrito = $request->session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'Tu bolsa está vacía.');
        }

        $totalEstimado = 0;
        foreach ($carrito as $item) {
            $totalEstimado += $item['precio'] * $item['cantidad'];
        }

        $userData = DB::connection('mongodb')->table('usuarios')
            ->where('_id', (int)Auth::id())
            ->first();

        $descuento = $request->session()->get('descuento');
        $totalFinal = $totalEstimado;
        $descuentoAplicado = 0;
        if ($descuento && ($descuento['porcentaje'] ?? 0) > 0) {
            $descuentoAplicado = $totalEstimado * ($descuento['porcentaje'] / 100);
            $totalFinal = $totalEstimado - $descuentoAplicado;
        }

        return view('Hustle.checkout', compact('carrito', 'totalEstimado', 'userData', 'descuento', 'descuentoAplicado', 'totalFinal'));
    }

    public function procesarPedido(Request $request)
    {
        if (!Auth::check()) return redirect()->route('login');

        $request->validate([
            'nombre'    => 'required|string|max:255',
            'telefono'  => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'notas'     => 'nullable|string|max:500',
        ]);

        $carrito = $request->session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito')->with('error', 'Tu bolsa está vacía.');
        }

        $total = 0;
        $items = [];
        foreach ($carrito as $id => $item) {
            $subtotal = $item['precio'] * $item['cantidad'];
            $total += $subtotal;
            $items[] = [
                'producto_id' => $item['id'] ?? $id,
                'nombre'      => $item['nombre'],
                'talla'       => $item['talla'] ?? 'M',
                'cantidad'    => $item['cantidad'],
                'precio'      => (float) $item['precio'],
                'subtotal'    => $subtotal,
            ];
        }

        $descuento = $request->session()->get('descuento');
        $totalFinal = $total;
        $descuentoAplicado = 0;
        $codigoUsado = null;
        if ($descuento && ($descuento['porcentaje'] ?? 0) > 0) {
            $descuentoAplicado = $total * ($descuento['porcentaje'] / 100);
            $totalFinal = $total - $descuentoAplicado;
            $codigoUsado = $descuento['codigo'];
        }

        $maxId = DB::connection('mongodb')->table('Pedidos')->max('_id');
        $nuevoId = ($maxId ? (int)$maxId : 0) + 1;

        DB::connection('mongodb')->table('Pedidos')->insert([
            '_id'             => $nuevoId,
            'usuario_id'      => Auth::id(),
            'cliente_nombre'  => $request->nombre,
            'cliente_telefono'=> $request->telefono,
            'direccion'       => $request->direccion,
            'notas'           => $request->notas,
            'items'           => $items,
            'total'           => $totalFinal,
            'descuento'       => $descuentoAplicado > 0 ? $descuentoAplicado : 0,
            'codigo_descuento'=> $codigoUsado,
            'estado'          => 'Pendiente',
            'fecha_creacion'  => now(),
        ]);

        $request->session()->put('ultimo_pedido_id', $nuevoId);

        $telefono = $this->getWhatsApp();
        $mensaje = "🛒 *NUEVO PEDIDO - HUSTLE HOUSE*\n\n";
        $mensaje .= "👤 *Cliente:* {$request->nombre}\n";
        $mensaje .= "📱 *Tel:* +503 {$request->telefono}\n";
        $mensaje .= "📍 *Dirección:* {$request->direccion}\n\n";
        $mensaje .= "📦 *Productos:*\n";
        foreach ($items as $item) {
            $mensaje .= "• {$item['nombre']} ({$item['talla']}) x{$item['cantidad']} - \${$item['subtotal']}\n";
        }
        if ($codigoUsado) {
            $mensaje .= "\n🎉 *Descuento {$descuento['porcentaje']}% ({$codigoUsado}):* -\${$descuentoAplicado}\n";
        }
        $mensaje .= "\n💰 *Total:* \${$totalFinal}\n";
        if ($request->notas) {
            $mensaje .= "\n📝 *Notas:* {$request->notas}\n";
        }
        $mensaje .= "\n✅ Pedido #{$nuevoId}";

        $whatsappUrl = 'https://wa.me/' . $telefono . '?text=' . urlencode($mensaje);

        $request->session()->forget('carrito');
        $request->session()->forget('descuento');

        return redirect()->away($whatsappUrl);
    }

    public function updateWhatsApp(Request $request)
    {
        $request->validate(['whatsapp' => 'required|string|max:20']);

        $telefono = preg_replace('/[^0-9]/', '', $request->whatsapp);
        if (substr($telefono, 0, 3) !== '503') {
            $telefono = '503' . $telefono;
        }

        $exists = DB::connection('mongodb')->table('config')
            ->where('key', 'whatsapp')
            ->first();

        if ($exists) {
            DB::connection('mongodb')->table('config')
                ->where('key', 'whatsapp')
                ->update(['value' => $telefono]);
        } else {
            DB::connection('mongodb')->table('config')->insert([
                'key'   => 'whatsapp',
                'value' => $telefono,
            ]);
        }

        return redirect()->route('admin.panel')->with('success', 'WhatsApp actualizado: +' . $telefono);
    }

}
