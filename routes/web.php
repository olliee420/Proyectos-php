<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HustleController;
 use App\Http\Controllers\AdminController;

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

// Ruta para añadir productos a la bolsa
Route::post('/carrito/agregar', [HustleController::class, 'agregarAlCarrito'])->name('carrito.agregar');


// ==========================================
// 4. ZONA EXCLUSIVA ADMINISTRADORES
// ==========================================

// 1. Ruta Maestra para cargar el Panel (Formulario + Tabla de Usuarios NoSQL)
Route::get('/admin/panel', [HustleController::class, 'showAdminPanel'])->name('admin.panel');

// 2. Ruta para procesar la subida física de la imagen y guardar la prenda en MongoDB
Route::post('/admin/productos/guardar', [HustleController::class, 'storeProducto'])->name('admin.productos.store');

// 3. CRUD de Productos
Route::get('/admin/productos/{id}/editar', [HustleController::class, 'editProducto'])->name('admin.productos.edit');
Route::put('/admin/productos/{id}', [HustleController::class, 'updateProducto'])->name('admin.productos.update');
Route::patch('/admin/productos/{id}/vendido', [HustleController::class, 'marcarVendido'])->name('admin.productos.vendido');
Route::delete('/admin/productos/{id}', [HustleController::class, 'destroyProducto'])->name('admin.productos.destroy');

// 4. Ruta segura para eliminar un cliente de la colección 'Usuarios'
Route::delete('/admin/usuarios/{id}', [HustleController::class, 'destroyUser'])->name('admin.users.destroy');
