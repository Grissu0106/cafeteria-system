@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <h1 class="text-2xl font-medium text-gray-800 mb-6">Nuevo Producto</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('productos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre') }}"
                       placeholder="Ej: Galleta Chocolate"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select name="tipo"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecciona tipo</option>
                    <option value="Galleta" {{ old('tipo') === 'Galleta' ? 'selected' : '' }}>Galleta</option>
                    <option value="Bebida caliente" {{ old('tipo') === 'Bebida caliente' ? 'selected' : '' }}>Bebida caliente</option>
                    <option value="Bebida fría" {{ old('tipo') === 'Bebida fría' ? 'selected' : '' }}>Bebida fría</option>
                    <option value="Snack" {{ old('tipo') === 'Snack' ? 'selected' : '' }}>Snack</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Precio (Bs.)</label>
                <input type="number" step="0.01" name="precio" value="{{ old('precio') }}"
                       placeholder="0.00"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock inicial</label>
                <input type="number" name="stock" value="{{ old('stock') }}"
                       placeholder="0"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    Guardar
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