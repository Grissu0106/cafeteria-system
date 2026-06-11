<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiProductoController;
use App\Http\Controllers\Api\ApiPedidoController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('productos', ApiProductoController::class);
    Route::apiResource('pedidos',   ApiPedidoController::class);
});