<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandModelController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAdressController;

use Illuminate\Support\Facades\Route;

// Rutas para el cliente
Route::get('/',               [HomeController::class, 'index'])->name('home');
Route::get('/model/{id}/',    [BrandModelController::class, 'indexShop'])->name('productosModelo');
Route::get('/detalles/{id}/', [ProductDetailController::class, 'index'])->name('detalleProducto');

// Rutas de Autenticación de Usuario
Route::get('/login',     [LoginController::class, 'index'])->name('login');
Route::post('/login',    [LoginController::class, 'store']);
Route::post('/logout',   [LogoutController::class, 'store'])->name('logout');
Route::get('/register',  [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Rutas del Perfil
Route::group([
    'prefix' => '/profile',
    'as' => 'profile.',
    'middleware' => ['auth']
], function () {
    Route::get('/',                              [ProfileController::class, 'index'])->name('index');
    Route::post('/',                             [ProfileController::class, 'store']);
    Route::post('/obtener-ubicacion',            [ProfileController::class, 'obtenerUbicacion'])->name('obtenerUbicacion');
    Route::post('/guardar-domicilio-usuario',    [UserAdressController::class, 'guardarDomicilioUsuario'])->name('guardarDomicilioUsuario');
    Route::delete('/eliminar-domicilio-usuario', [UserAdressController::class, 'eliminarDomicilioUsuario'])->name('eliminarDomicilioUsuario');
});


// Rutas de Carrito de compras
Route::group([
    'prefix' => '/carrito', 
    'as' => 'cart.',
    'middleware' => ['auth']
], function () {
    Route::get('/productos',                    [CartController::class, 'index'])->name('carrito');
    Route::post('/agregar-producto',            [CartController::class, 'guardarProducto'])->name('guardarProducto');
    Route::put('/actualizar-stock/{cart}',      [CartController::class, 'update'])->name('actualizarStock');
    Route::delete('/eliminar-producto/{cart}',  [CartController::class, 'destroy'])->name('eliminarProducto');
});


// Rutas de pedido
Route::group([
    'prefix' => '/pedido', 
    'as' => 'order.',
    'middleware' => ['auth']
], function () {
    Route::get('/nuevo',   [OrderController::class, 'index'])->name('index');
    Route::get('/generar', [OrderController::class, 'generateOrder'])->name('generateOrder');
});


// Rutas del Panel de Administración 
Route::group([
    'prefix' => '/admin', 
    'as' => 'admin.',
    'middleware' => ['auth', 'checkadmin']
], function () {
    
    // DASHBOARD
    Route::get('/', [AdminController::class,   'index'])->name('dashboard');

    // MARCAS
    Route::get('/marcas',          [BrandController::class, 'index'])->name('marcas');
    Route::post('/guardar-marca',  [BrandController::class, 'guardarMarca'])->name('guardarMarca');
    Route::post('/eliminar-marca', [BrandController::class, 'destroy'])->name('eliminarMarca');

    // MODELOS
    Route::get('/modelos',          [BrandModelController::class, 'index'])->name('modelos');
    Route::post('/guardar-modelo',  [BrandModelController::class, 'guardarModelo'])->name('guardarModelo');
    Route::post('/eliminar-modelo', [BrandModelController::class, 'destroy'])->name('eliminarModelo');

    // PRODUCTOS
    Route::get('/produtos',                    [ProductController::class, 'index'])->name('productos');
    Route::get('/guardar-producto',            [ProductController::class, 'nuevoProducto'])->name('productos.guardar');
    Route::get('/guardar-producto/{id}',       [ProductController::class, 'editarProducto'])->name('productos.editar');
    Route::post('/guardar-producto',           [ProductController::class, 'guardarProducto']);
    Route::delete('/eliminar-producto',        [ProductController::class, 'destroy'])->name('productos.eliminar');
    Route::post('/eliminar-producto-imagen',   [ProductImageController::class, 'destroy'])->name('productos.eliminar.imagen');
    Route::post('/obtener-modelos',            [ProductController::class, 'obtenerModelos'])->name('obtenerModelos');

});
