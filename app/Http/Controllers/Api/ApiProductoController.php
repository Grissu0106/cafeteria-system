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
        $request->validate([
            'nombre' => 'required|string',
            'tipo'   => 'required|string',
            'precio' => 'required|numeric',
            'stock'  => 'required|integer',
        ]);

        $producto = Producto::create($request->all());

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
        $request->validate([
            'nombre' => 'required|string',
            'tipo'   => 'required|string',
            'precio' => 'required|numeric',
            'stock'  => 'required|integer',
        ]);

        $producto->update($request->all());

        return response()->json([
            'message' => 'Producto actualizado.',
            'data'    => $producto
        ], 200);
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return response()->json([
            'message' => 'Producto eliminado.'
        ], 200);
    }
}