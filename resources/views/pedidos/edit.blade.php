@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <h1 class="text-2xl font-medium text-gray-800 mb-6">Editar Pedido</h1>

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('pedidos.update', $pedido) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                <input type="text" name="cliente" value="{{ old('cliente', $pedido->cliente) }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 text-sm space-y-1">
                <div class="flex justify-between">
                    <span class="text-gray-500">Producto:</span>
                    <span class="font-medium text-gray-800">{{ $pedido->producto->nombre }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Cantidad:</span>
                    <span class="font-medium text-gray-800">{{ $pedido->cantidad }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500">Total:</span>
                    <span class="font-medium text-gray-800">Bs. {{ number_format($pedido->total, 2) }}</span>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select name="estado"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="Pendiente" {{ $pedido->estado === 'Pendiente' ? 'selected' : '' }}>
                        Pendiente
                    </option>
                    <option value="Entregado" {{ $pedido->estado === 'Entregado' ? 'selected' : '' }}>
                        Entregado
                    </option>
                </select>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-yellow-500 text-white py-2 rounded-lg text-sm font-medium hover:bg-yellow-600 transition">
                    Actualizar
                </button>
                <a href="{{ route('pedidos.index') }}"
                   class="flex-1 text-center border border-gray-300 text-gray-600 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

@endsection