<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PedidoController;
use App\Models\Producto;

Route::get('/', function () {
    return redirect('/productos');
});

Route::resource('productos', ProductoController::class);
Route::resource('pedidos', PedidoController::class);

Route::get('/test-productos', function () {
    return Producto::all();
});