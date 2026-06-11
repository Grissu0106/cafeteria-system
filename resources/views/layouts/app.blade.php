<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Cafetería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

    <nav class="bg-white border-b border-gray-200 px-6 py-3 flex items-center gap-6">
        <span class="font-medium text-gray-800">☕ Cafetería</span>
        <a href="{{ route('productos.index') }}"
           class="text-sm text-gray-500 hover:text-gray-800 transition
           {{ request()->routeIs('productos.*') ? 'text-blue-600 font-medium' : '' }}">
            Productos
        </a>
        <a href="{{ route('pedidos.index') }}"
           class="text-sm text-gray-500 hover:text-gray-800 transition
           {{ request()->routeIs('pedidos.*') ? 'text-blue-600 font-medium' : '' }}">
            Pedidos
        </a>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>