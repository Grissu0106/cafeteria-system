@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-medium text-gray-800">Pedidos</h1>
    <a href="{{ route('pedidos.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
        + Nuevo Pedido
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4 text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
            <tr>
                <th class="px-4 py-3 text-left">ID</th>
                <th class="px-4 py-3 text-left">Cliente</th>
                <th class="px-4 py-3 text-left">Producto</th>
                <th class="px-4 py-3 text-left">Cantidad</th>
                <th class="px-4 py-3 text-left">Total</th>
                <th class="px-4 py-3 text-left">Estado</th>
                <th class="px-4 py-3 text-left">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse($pedidos as $pedido)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-400">{{ $pedido->id }}</td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $pedido->cliente }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $pedido->producto->nombre }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $pedido->cantidad }}</td>
                <td class="px-4 py-3 text-gray-800 font-medium">Bs. {{ number_format($pedido->total, 2) }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-1 rounded-full text-xs font-medium
                        {{ $pedido->estado === 'Entregado'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-yellow-100 text-yellow-700' }}">
                        {{ $pedido->estado }}
                    </span>
                </td>
                <td class="px-4 py-3 flex gap-2">
                    <a href="{{ route('pedidos.show', $pedido) }}"
                       class="text-blue-600 hover:underline text-xs">Ver</a>
                    <a href="{{ route('pedidos.edit', $pedido) }}"
                       class="text-yellow-600 hover:underline text-xs">Editar</a>
                    <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST"
                          onsubmit="return confirm('¿Eliminar este pedido?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline text-xs">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-4 py-8 text-center text-gray-400">
                    No hay pedidos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $pedidos->links() }}
</div>

@endsection