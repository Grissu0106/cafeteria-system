<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class ApiPedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('producto')->get();

        return response()->json([
            'data' => $pedidos
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente'     => 'required|string',
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        if ($request->cantidad > $producto->stock) {
            return response()->json([
                'message' => 'Stock insuficiente.',
                'stock_disponible' => $producto->stock
            ], 422);
        }

        $total = $producto->precio * $request->cantidad;

        $pedido = Pedido::create([
            'cliente'     => $request->cliente,
            'producto_id' => $request->producto_id,
            'cantidad'    => $request->cantidad,
            'total'       => $total,
            'estado'      => 'Pendiente',
        ]);

        $producto->stock -= $request->cantidad;
        $producto->save();

        return response()->json([
            'message' => 'Pedido creado y stock descontado.',
            'data'    => $pedido->load('producto')
        ], 201);
    }

    public function show(Pedido $pedido)
    {
        return response()->json([
            'data' => $pedido->load('producto')
        ], 200);
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente' => 'required|string',
            'estado'  => 'required|in:Pendiente,Entregado',
        ]);

        $pedido->update($request->only(['cliente', 'estado']));

        return response()->json([
            'message' => 'Pedido actualizado.',
            'data'    => $pedido
        ], 200);
    }

    public function destroy(Pedido $pedido)
    {
        $producto = $pedido->producto;
        $producto->stock += $pedido->cantidad;
        $producto->save();

        $pedido->delete();

        return response()->json([
            'message' => 'Pedido eliminado y stock restaurado.'
        ], 200);
    }
}