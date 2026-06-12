<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Cafetería</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">
    
    <nav class="bg-white border-b border-gray-200 px-6 py-4 flex justify-between items-center shadow-sm">
        
        <div class="flex items-center gap-6">
            <span class="font-bold text-lg text-gray-800 tracking-tight">☕ Cafetería</span>
            
            <div class="h-6 w-px bg-gray-300 hidden md:block"></div> <a href="{{ route('productos.index') }}"
               class="text-sm transition-colors {{ request()->routeIs('productos.*') ? 'text-blue-600 font-semibold' : 'text-gray-500 hover:text-gray-800' }}">
                Productos
            </a>
            <a href="{{ route('pedidos.index') }}"
               class="text-sm transition-colors {{ request()->routeIs('pedidos.*') ? 'text-blue-600 font-semibold' : 'text-gray-500 hover:text-gray-800' }}">
                Pedidos
            </a>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <span class="text-sm text-gray-500">
                    Hola, <b class="text-gray-800">{{ auth()->user()->name }}</b>
                </span>
                
                <div class="h-5 w-px bg-gray-200"></div> <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="text-sm font-medium text-red-500 hover:text-red-700 hover:underline transition">
                        Cerrar Sesión
                    </button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-6 py-8">
        @yield('content')
    </main>

</body>
</html>