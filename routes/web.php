<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HustleController;

/*

|--------------------------------------------------------------------------
| Web Routes - Hustle House Streetwear
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. RUTAS PÚBLICAS (Invitados)
// ==========================================

// Redirigir la raíz directamente al formulario de ingreso
Route::get('/', function () { 
    return redirect()->route('login'); 
})->name('welcome');

// Vistas y Procesamientos de Autenticación Básica
Route::get('/login', [HustleController::class, 'showLogin'])->name('login');
Route::post('/login', [HustleController::class, 'login'])->name('login.post');
Route::post('/registro', [HustleController::class, 'registro'])->name('registro.post');
Route::get('/logout', [HustleController::class, 'logout'])->name('logout');


// ==========================================
// 2. RUTAS COMPARTIDAS (Clientes y Administradores)
// ==========================================
Route::get('/menu', [HustleController::class, 'showMenu'])->name('menu');
Route::get('/perfil', [HustleController::class, 'showPerfil'])->name('perfil');
Route::get('/catalogo', [HustleController::class, 'showCatalogo'])->name('catalogo');
Route::get('/index', [HustleController::class, 'showIndex'])->name('index');


// ==========================================
// 3. ZONA EXCLUSIVA CLIENTES
// ==========================================
Route::get('/cliente/carrito', [HustleController::class, 'showCarrito'])->name('carrito');
Route::get('/cliente/pedidos', [HustleController::class, 'showPedidos'])->name('pedidos');


// ==========================================
// 4. ZONA EXCLUSIVA ADMINISTRADORES
// ==========================================
Route::get('/admin/historial', [HustleController::class, 'showHistorial'])->name('admin.historial');
Route::post('/admin/productos/guardar', [HustleController::class, 'storeProducto'])->name('admin.productos.store');
