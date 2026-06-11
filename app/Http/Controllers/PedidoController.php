<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index()
    {
        $pedidos = Pedido::with('producto')->paginate(5);
        return view('pedidos.index', compact('pedidos'));
    }

    public function create()
    {
        $productos = Producto::where('stock', '>', 0)->get();
        return view('pedidos.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente'     => 'required|string|max:255',
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $producto = Producto::findOrFail($request->producto_id);

        // Validar stock suficiente
        if ($request->cantidad > $producto->stock) {
            return back()
                ->withErrors(['cantidad' => 'Stock insuficiente. Solo hay ' . $producto->stock . ' unidades disponibles.'])
                ->withInput();
        }

        // Calcular total automáticamente
        $total = $producto->precio * $request->cantidad;

        // Crear pedido
        Pedido::create([
            'cliente'     => $request->cliente,
            'producto_id' => $request->producto_id,
            'cantidad'    => $request->cantidad,
            'total'       => $total,
            'estado'      => 'Pendiente',
        ]);

        // Descontar stock
        $producto->stock -= $request->cantidad;
        $producto->save();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido registrado y stock actualizado.');
    }

    public function show(Pedido $pedido)
    {
        return view('pedidos.show', compact('pedido'));
    }

    public function edit(Pedido $pedido)
    {
        $productos = Producto::all();
        return view('pedidos.edit', compact('pedido', 'productos'));
    }

    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'cliente' => 'required|string|max:255',
            'estado'  => 'required|in:Pendiente,Entregado',
        ]);

        $pedido->update([
            'cliente' => $request->cliente,
            'estado'  => $request->estado,
        ]);

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido actualizado.');
    }

    public function destroy(Pedido $pedido)
    {
        // Devolver stock al eliminar pedido
        $producto = $pedido->producto;
        $producto->stock += $pedido->cantidad;
        $producto->save();

        $pedido->delete();

        return redirect()->route('pedidos.index')
            ->with('success', 'Pedido eliminado y stock restaurado.');
    }
}