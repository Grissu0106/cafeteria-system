<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
{
    $buscar = $request->get('buscar', '');

    $productos = Producto::where('nombre', 'like', "%$buscar%")
        ->paginate(5);

    return view('productos.index', compact('productos'));
}

    public function create()
    {
        if (auth()->user()->email !== 'admin@cafeteria.com') abort(403, 'No tienes permiso para hacer esto.');
        return view('productos.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->email !== 'admin@cafeteria.com') abort(403, 'No tienes permiso para hacer esto.');

        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index');
    }

    public function show(Producto $producto)
    {
        $producto->load('pedidos');
        
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        if (auth()->user()->email !== 'admin@cafeteria.com') abort(403, 'No tienes permiso para hacer esto.');
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        if (auth()->user()->email !== 'admin@cafeteria.com') abort(403, 'No tienes permiso para hacer esto.');

        $request->validate([
            'nombre' => 'required',
            'tipo' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer'
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        if (auth()->user()->email !== 'admin@cafeteria.com') abort(403, 'No tienes permiso para hacer esto.');
        if ($producto->pedidos()->count() > 0) {
            return redirect()->route('productos.index')
                ->with('error', 'No se puede eliminar el producto porque tiene pedidos asociados.');
        }

        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}