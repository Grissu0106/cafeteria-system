@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-medium text-gray-800">Productos</h1>
    @if(auth()->user()->email === 'admin@cafeteria.com')
        <a href="{{ route('productos.create') }}"
        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
            + Nuevo Producto
        </a>
    @endif
</div>

<form method="GET" class="mb-4 flex gap-2">
    <input type="text" name="buscar" value="{{ request('buscar') }}"
           placeholder="Buscar por nombre..."
           class="border border-gray-300 rounded-lg px-3 py-2 text-sm w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">
    <button class="bg-gray-100 border border-gray-300 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
        Buscar
    </button>
    @if(request('buscar'))
        <a href="{{ route('productos.index') }}"
           class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700">
            Limpiar
        </a>
    @endif
</form>

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">Nombre</th>
                <th class="px-4 py-3 text-left">Tipo</th>
                <th class="px-4 py-3 text-left">Precio</th>
                <th class="px-4 py-3 text-left">Stock</th>
                <th class="px-4 py-3 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($productos as $producto)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 font-medium text-gray-800">{{ $producto->nombre }}</td>
                <td class="px-4 py-3 text-gray-500">{{ $producto->tipo }}</td>
                <td class="px-4 py-3 text-gray-700">Bs. {{ number_format($producto->precio, 2) }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $producto->stock > 5
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-600' }}">
                        {{ $producto->stock }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-3">
                    <a href="{{ route('productos.show', $producto) }}" 
                    class="text-blue-600 hover:underline text-xs">Ver</a>
                    
                    @if(auth()->user()->email === 'admin@cafeteria.com')
                        <a href="{{ route('productos.edit', $producto) }}"
                        class="text-yellow-600 hover:underline text-xs">Editar</a>
                        
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar {{ $producto->nombre }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline text-xs">
                                Eliminar
                            </button>
                        </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-4 py-8 text-center text-gray-400">
                    No se encontraron productos.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $productos->links() }}
</div>

@endsection