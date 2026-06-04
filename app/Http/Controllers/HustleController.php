<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

                return redirect()->to('/menu');
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

        $ultimoUsuario = DB::connection('mongodb')->table('Usuarios')
            ->orderBy('_id', 'desc')->first();
            
        // Blindaje para la lectura del ID incremental en el registro
        $ultimoId = $ultimoUsuario ? ((array) $ultimoUsuario)['_id'] : 0;
        $nuevoId = $ultimoId + 1;

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

        return redirect()->to('/menu');
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
        return view('Hustle.menu');
    }

    // Muestra el perfil del usuario activo (Cliente o Administrador)
    public function showPerfil() {
        if (!session()->has('usuario_autenticado')) return redirect()->route('login');
        return view('Hustle.perfil');
    }

    // Muestra el catálogo de Streetwear
    public function showCatalogo() {
        if (!session()->has('usuario_autenticado')) return redirect()->route('login');
        return view('Hustle.catalogo');
    }

    // ZONA EXCLUSIVA CLIENTES
    public function showCarrito() { 
        if (!session()->has('usuario_autenticado') || session('usuario_rol') !== 'cliente') return redirect()->route('login');
        return view('Hustle.carrito'); 
    }

    public function showPedidos() { 
        if (!session()->has('usuario_autenticado') || session('usuario_rol') !== 'cliente') return redirect()->route('login');
        return view('Hustle.pedidos'); 
    }

    // ZONA EXCLUSIVA ADMINISTRADORES
    public function showHistorial() { 
        if (!session()->has('usuario_autenticado') || session('usuario_rol') !== 'admin') return redirect()->route('login');
        return view('Hustle.historial'); 
    }

    public function storeProducto(Request $request) {
        // Se programará en el módulo de catálogo
    }
}
