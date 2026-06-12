<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\WebAuthController;
use App\Models\Producto;

// Rutas públicas
Route::get('/login', [WebAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.post');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
    
    Route::get('/', function () {
        return redirect('/productos');
    });

    Route::resource('productos', ProductoController::class);
    Route::resource('pedidos', PedidoController::class);

    Route::get('/test-productos', function () {
        return Producto::all();
    });
});