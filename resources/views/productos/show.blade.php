@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-medium text-gray-800">Detalles del Producto</h1>
        <a href="{{ route('productos.index') }}" class="text-gray-500 hover:text-gray-700 text-sm flex items-center gap-1">
            &larr; Volver a la lista
        </a>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Nombre</p>
                <p class="text-lg text-gray-800 font-medium">{{ $producto->nombre }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Tipo</p>
                <p class="text-gray-800">{{ $producto->tipo }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Precio</p>
                <p class="text-gray-800">Bs. {{ number_format($producto->precio, 2) }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500 mb-1">Stock Actual</p>
                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $producto->stock > 5 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                    {{ $producto->stock }} unidades
                </span>
            </div>
        </div>

        @if(auth()->user()->email === 'admin@cafeteria.com')
            <div class="mt-6 pt-6 border-t border-gray-100 flex gap-3">
                <a href="{{ route('productos.edit', $producto) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition">
                    Editar Producto
                </a>
            </div>
        @endif
    </div>

    <h2 class="text-lg font-medium text-gray-800 mb-4">Historial de Pedidos</h2>
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        @if($producto->pedidos && $producto->pedidos->count() > 0)
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Nº Pedido</th>
                        <th class="px-4 py-3 text-left">Cliente</th>
                        <th class="px-4 py-3 text-left">Cantidad</th>
                        <th class="px-4 py-3 text-left">Total</th>
                        <th class="px-4 py-3 text-left">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($producto->pedidos as $pedido)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800">#{{ $pedido->id }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $pedido->cliente }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $pedido->cantidad }}</td>
                        <td class="px-4 py-3 text-gray-800 font-medium">Bs. {{ number_format($pedido->total, 2) }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded-full text-xs font-medium {{ $pedido->estado == 'Pendiente' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ $pedido->estado }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="p-8 text-center text-gray-500 text-sm">
                Aún no hay pedidos registrados para este producto.
            </div>
        @endif
    </div>
</div>

@endsection