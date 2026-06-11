<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;


class HustleController extends Controller
{
    // Muestra la vista de Login/Registro
    public function showLogin() {
        return view('Hustle.login');
    }

    // Procesa el inicio de sesión de forma segura y blindada
    public function login(Request $request) 
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Consulta directa a MongoDB
        $resultado = DB::connection('mongodb')->table('Usuarios')
            ->where('email', $credentials['email'])->first();

        if ($resultado) {
            // BLINDAJE: Forzamos la conversión a Arreglo para admitir guiones bajos y evitar fallos de stdClass
            $usuario = (array) $resultado;

            if ($credentials['password'] === $usuario['password'] || Hash::check($credentials['password'], $usuario['password'])) {
                
                // Guardamos los datos de forma segura usando corchetes tradicionales
                $request->session()->put('usuario_autenticado', true);
                $request->session()->put('usuario_id', $usuario['_id'] ?? null);
                $request->session()->put('usuario_nombre', $usuario['nombre'] ?? 'Usuario');
                $request->session()->put('usuario_rol', $usuario['rol'] ?? 'cliente');
                $request->session()->regenerate();

                return redirect()->to('/perfil');
            }
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    // Procesa el registro insertando directamente en MongoDB
    public function registro(Request $request) 
    {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:6|confirmed',
    ]);

    $existe = DB::connection('mongodb')->table('Usuarios')
        ->where('email', $request->email)->first();

    if ($existe) {
        return back()->withErrors(['email' => 'Este correo electrónico ya está registrado.']);
    }

    // SOLUCIÓN PARA MONGO: Obtenemos el último documento insertado ordenándolo de forma descendente por _id
    $ultimoUsuario = DB::connection('mongodb')->table('Usuarios')
        ->orderBy('_id', 'desc')
        ->first();
        
    // Si la colección está vacía inicializamos en 0, de lo contrario extraemos el ID numérico
    // Manejamos tanto formato de objeto como de array por compatibilidad con el driver de MongoDB
    if (!$ultimoUsuario) {
        $ultimoId = 0;
    } else {
        $ultimoId = is_array($ultimoUsuario) ? ($ultimoUsuario['_id'] ?? 0) : ($ultimoUsuario->_id ?? 0);
    }
        
    // Forzamos a entero y sumamos 1 para el nuevo registro consecutivo
    $nuevoId = (int)$ultimoId + 1;

    DB::connection('mongodb')->table('Usuarios')->insert([
        '_id' => $nuevoId,
        'nombre' => $request->nombre,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'rol' => 'cliente',
        'fecha_creacion' => now()
    ]);

    // Iniciar la sesión de forma inmediata con los datos creados
    $request->session()->put('usuario_autenticado', true);
    $request->session()->put('usuario_id', $nuevoId);
    $request->session()->put('usuario_nombre', $request->nombre);
    $request->session()->put('usuario_rol', 'cliente');
    $request->session()->regenerate();

    return redirect()->to('/index');
    }


    // Cierre de sesión limpio
    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
    
    // Redirecciona al menú principal dinámico
    public function showMenu() {
        if (!session()->has('usuario_autenticado')) return redirect()->route('login');
        return view('Hustle.perfil');
    }

    // Muestra la pantalla principal de la tienda (Index)
    public function showIndex() {
    if (!session()->has('usuario_autenticado')) return redirect()->route('login');
    return view('Hustle.index'); 
}


    // Muestra el perfil del usuario activo (Cliente o Administrador)
    public function showPerfil() {
        if (!session()->has('usuario_autenticado')) return redirect()->route('login');
        return view('Hustle.perfil');
    }

    // Muestra el catálogo de Streetwear
    public function showCatalogo()
{
    // Recupera todos los productos guardados en tu colección de MongoDB
    $productos = DB::connection('mongodb')->table('products')->get();

    // Carga la vista enviándole la colección de datos
    return view('Hustle.catalogo', compact('productos'));
}


    // ZONA EXCLUSIVA CLIENTES
    public function showCarrito(Request $request)
    {
    // Obtener el carrito de la sesión (si no existe, pasará un array vacío)
    $carrito = $request->session()->get('carrito', []);

    // Calcular el costo total sumando los precios de los artículos agregados
    $totalEstimado = 0;
    foreach($carrito as $item) {
        $totalEstimado += $item['precio'] * $item['cantidad'];
    }

    return view('Hustle.carrito', compact('carrito', 'totalEstimado'));
    }

    public function agregarAlCarrito(Request $request)

    {
    // 1. Validar que vengan los datos obligatorios del catálogo
    $request->validate([
        'producto_id' => 'required',
        'talla'       => 'required|string'
    ]);

    // 2. Buscar los datos reales de la prenda en MongoDB usando su _id (convertido a entero)
    $producto = DB::connection('mongodb')->table('products')
        ->where('_id', (int)$request->producto_id)
        ->first();

    if (!$producto) {
        return redirect()->back()->with('error', 'El producto no se encuentra disponible.');
    }

    // Convertir el documento a array para mayor comodidad en el manejo de sesiones NoSQL
    $producto = (array) $producto;

    // 3. Recuperar el carrito actual de la sesión (o inicializarlo si está vacío)
    $carrito = $request->session()->get('carrito', []);

    // Creamos una clave única combinando el ID y la Talla (así diferenciamos si compran la misma prenda en tallas distintas)
    $cartKey = $producto['_id'] . '_' . $request->talla;

    // 4. Si el artículo ya existe en la bolsa, sumamos 1 a la cantidad
    if (isset($carrito[$cartKey])) {
        $carrito[$cartKey]['cantidad']++;
    } else {
        // Si es nuevo, estructuramos el documento dentro del array del carrito
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

    // 5. Guardar el estado actualizado en la sesión del usuario
    $request->session()->put('carrito', $carrito);

    return redirect()->route('carrito')->with('success', '¡Prenda añadida a tu bolsa con éxito!');
    }


    public function showPedidos(Request $request)
    {
    // 1. Obtener el ID del usuario logueado desde la sesión manual que creamos
    $usuarioId = $request->session()->get('usuario_id');

    // 2. Consultar en MongoDB los pedidos de ESTE usuario específico
    $pedidos = DB::connection('mongodb')->table('Pedidos')
                ->where('usuario_id', $usuarioId)
                ->orderBy('fecha_creacion', 'desc')
                ->get();

    // 3. Mandar la variable a la vista pedidos.blade.php
    return view('Hustle.pedidos', compact('pedidos'));
    }


    // ZONA EXCLUSIVA ADMINISTRADORES

    public function showAdminPanel()
{
    // Consultamos la colección 'Usuarios' de MongoDB ordenando por los más recientes
    $usuarios = \Illuminate\Support\Facades\DB::connection('mongodb')->table('Usuarios')
        ->orderBy('fecha_creacion', 'desc')
        ->get();
    
    // Retornamos la vista en la carpeta Hustle
    return view('Hustle.historial', compact('usuarios'));
}

public function destroyUser($id)
{
    // Eliminamos el cliente de MongoDB mapeando el ID único numérico
    \Illuminate\Support\Facades\DB::connection('mongodb')->table('Usuarios')
        ->where('_id', (int)$id)
        ->delete();

    return redirect()->back()->with('success', 'El usuario ha sido eliminado correctamente de Hustle House.');
}

    public function showHistorial()
{
    // Consultamos la colección 'Usuarios' de MongoDB ordenando por los más recientes
    $usuarios = DB::connection('mongodb')->table('Usuarios')
        ->orderBy('fecha_creacion', 'desc')
        ->get();

    // Retornamos la vista inyectándole la colección de datos real
    return view('Hustle.historial', compact('usuarios'));
}


    public function storeProducto(Request $request) 
{
    // 1. Validación estricta de los campos y del archivo físico
    $request->validate([
        'categoria' => 'required|string',
        'nombre'    => 'required|string|max:255',
        'sku'       => 'required|string',
        'precio'    => 'required|numeric|min:0',
        'costo'     => 'required|numeric|min:0',
        'imagen'    => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Límite de 2MB
    ]);

    // Verificamos si ya existe el SKU en la base de datos para evitar duplicados
    $skuExiste = \Illuminate\Support\Facades\DB::connection('mongodb')->table('products')
        ->where('sku', strtoupper($request->sku))
        ->first();

    if ($skuExiste) {
        return redirect()->back()->withErrors(['sku' => 'El SKU ingresado ya pertenece a otra prenda registrada.'])->withInput();
    }

    // 2. CORRECCIÓN: Generación robusta del ID Numérico Autoincrementable para MongoDB NoSQL
    // Buscamos directamente el valor numérico más alto registrado en la colección
    $maxId = \Illuminate\Support\Facades\DB::connection('mongodb')->table('products')->max('_id');
    
    // Si max() devuelve null (colección vacía), iniciamos en 0. Si no, forzamos a entero el ID más alto.
    $ultimoId = $maxId ? (int)$maxId : 0;
    
    // Sumamos 1 de forma estricta para garantizar que el nuevo ID sea el consecutivo correcto
    $nuevoId = $ultimoId + 1;

    // 3. Procesar y guardar la imagen física localmente en el servidor
    $rutaImagen = 'uploads/products/default.jpg'; // Imagen por defecto de respaldo

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        
        // Creamos un nombre limpio y único usando la estampa de tiempo actual
        $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        
        // Definimos el directorio de destino dentro de la carpeta pública
        $destinationPath = public_path('uploads/products');
        
        // Si la carpeta no existe de forma local, el servidor la creará automáticamente
        if (!\Illuminate\Support\Facades\File::exists($destinationPath)) {
            \Illuminate\Support\Facades\File::makeDirectory($destinationPath, 0755, true, true);
        }

        // Movemos físicamente la foto subida al directorio
        $file->move($destinationPath, $filename);
        
        // Guardamos la ruta relativa final que requiere el HTML para renderizar
        $rutaImagen = 'uploads/products/' . $filename;
    }

    // 4. Inserción directa del documento en la colección NoSQL de MongoDB
    \Illuminate\Support\Facades\DB::connection('mongodb')->table('products')->insert([
        '_id'            => $nuevoId,
        'categoria'      => $request->categoria,
        'nombre'         => $request->nombre,
        'sku'            => strtoupper($request->sku),
        'precio'         => (float) $request->precio,
        'costo'          => (float) $request->costo,
        'imagen_path'    => $rutaImagen,
        'fecha_creacion' => now()
    ]);

    // Regresamos al panel inyectando un mensaje temporal de éxito
    return redirect()->route('admin.panel')->with('success', '¡Prenda guardada y publicada exitosamente en el drop!');
}


}
