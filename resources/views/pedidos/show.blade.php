@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('pedidos.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">← Volver</a>
        <h1 class="text-2xl font-medium text-gray-800">Pedido #{{ $pedido->id }}</h1>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 p-6 space-y-4">

        <div class="flex justify-between items-center pb-4 border-b border-gray-100">
            <span class="text-gray-500 text-sm">Estado</span>
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $pedido->estado === 'Entregado'
                    ? 'bg-green-100 text-green-700'
                    : 'bg-yellow-100 text-yellow-700' }}">
                {{ $pedido->estado }}
            </span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Cliente</span>
            <span class="font-medium text-gray-800">{{ $pedido->cliente }}</span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Producto</span>
            <span class="font-medium text-gray-800">{{ $pedido->producto->nombre }}</span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Tipo</span>
            <span class="text-gray-600">{{ $pedido->producto->tipo }}</span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Precio unitario</span>
            <span class="text-gray-600">Bs. {{ number_format($pedido->producto->precio, 2) }}</span>
        </div>

        <div class="flex justify-between text-sm">
            <span class="text-gray-500">Cantidad</span>
            <span class="text-gray-600">{{ $pedido->cantidad }}</span>
        </div>

        <div class="flex justify-between text-sm pt-3 border-t border-gray-100">
            <span class="font-medium text-gray-700">Total</span>
            <span class="font-medium text-gray-800 text-base">Bs. {{ number_format($pedido->total, 2) }}</span>
        </div>

        <div class="flex justify-between text-sm text-gray-400">
            <span>Registrado</span>
            <span>{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
        </div>

    </div>

    <div class="flex gap-3 mt-4">
        <a href="{{ route('pedidos.edit', $pedido) }}"
           class="flex-1 text-center bg-yellow-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition">
            Editar
        </a>
        <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST"
              onsubmit="return confirm('¿Eliminar este pedido?')" class="flex-1">
            @csrf
            @method('DELETE')
            <button type="submit"
                    class="w-full bg-red-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                Eliminar
            </button>
        </form>
    </div>

</div>

@endsection