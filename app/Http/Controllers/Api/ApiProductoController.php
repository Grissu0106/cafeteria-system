<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ApiProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();

        return response()->json([
            'data' => $productos
        ], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|unique:productos,nombre|max:255',
            'tipo'   => 'required|string|in:Galleta,Bebida,Bebida caliente,Bebida fría,Snack',
            'precio' => 'required|numeric|min:0.1',
            'stock'  => 'required|integer|min:0'
        ]);

        $producto = Producto::create($validated);

        return response()->json([
            'message' => 'Producto creado.',
            'data'    => $producto
        ], 201);
    }

    public function show(Producto $producto)
    {
        return response()->json([
            'data' => $producto
        ], 200);
    }

    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:productos,nombre,' . $producto->id,
            'tipo'   => 'required|string|in:Galleta,Bebida,Bebida caliente,Bebida fría,Snack',
            'precio' => 'required|numeric|min:0.1',
            'stock'  => 'required|integer|min:0',
        ]);

        $producto->update($validated);

        return response()->json([
            'message' => 'Producto actualizado.',
            'data'    => $producto
        ], 200);
    }

    public function destroy(Producto $producto)
    {
        if ($producto->pedidos()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar el producto porque tiene pedidos asociados.'
            ], 422);
        }

        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado exitosamente.'
        ], 200);
    }
}