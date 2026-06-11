@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <h1 class="text-2xl font-medium text-gray-800 mb-6">Editar Producto</h1>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('productos.update', $producto) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select name="tipo"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Galleta" {{ $producto->tipo === 'Galleta' ? 'selected' : '' }}>Galleta</option>
                    <option value="Bebida caliente" {{ $producto->tipo === 'Bebida caliente' ? 'selected' : '' }}>Bebida caliente</option>
                    <option value="Bebida fría" {{ $producto->tipo === 'Bebida fría' ? 'selected' : '' }}>Bebida fría</option>
                    <option value="Snack" {{ $producto->tipo === 'Snack' ? 'selected' : '' }}>Snack</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio (Bs.)</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio', $producto->precio) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-yellow-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition">
                    Actualizar
                </button>
                <a href="{{ route('productos.index') }}"
                   class="flex-1 text-center border border-gray-300 text-gray-600 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

@endsection