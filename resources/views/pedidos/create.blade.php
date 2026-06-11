@extends('layouts.app')

@section('content')

<div class="max-w-lg mx-auto">

    <h1 class="text-2xl font-medium text-gray-800 mb-6">Nuevo Pedido</h1>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-lg mb-4 text-sm">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <form action="{{ route('pedidos.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                <input type="text" name="cliente" value="{{ old('cliente') }}"
                       placeholder="Nombre del cliente"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Producto</label>
                <select name="producto_id" id="producto_select"
                        onchange="actualizarPrecio()"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecciona un producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->id }}"
                                data-precio="{{ $producto->precio }}"
                                data-stock="{{ $producto->stock }}"
                                {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                            {{ $producto->nombre }} — Bs. {{ $producto->precio }} (stock: {{ $producto->stock }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad_input"
                       value="{{ old('cantidad', 1) }}" min="1"
                       onchange="actualizarPrecio()"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Total estimado:</span>
                    <span id="total_preview" class="font-medium text-gray-800">Bs. 0.00</span>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    Registrar Pedido
                </button>
                <a href="{{ route('pedidos.index') }}"
                   class="flex-1 text-center border border-gray-300 text-gray-600 py-2 rounded-lg text-sm hover:bg-gray-50 transition">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function actualizarPrecio() {
    const select = document.getElementById('producto_select');
    const cantidad = parseInt(document.getElementById('cantidad_input').value) || 0;
    const option = select.options[select.selectedIndex];
    const precio = parseFloat(option.dataset.precio) || 0;
    const total = (precio * cantidad).toFixed(2);
    document.getElementById('total_preview').textContent = 'Bs. ' + total;
}
</script>

@endsection