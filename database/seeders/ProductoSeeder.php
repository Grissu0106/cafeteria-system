<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Galleta Chocolate',
            'tipo' => 'Galleta',
            'precio' => 5,
            'stock' => 20
        ]);

        Producto::create([
            'nombre' => 'Galleta Vainilla',
            'tipo' => 'Galleta',
            'precio' => 4,
            'stock' => 15
        ]);

        Producto::create([
            'nombre' => 'Capuccino',
            'tipo' => 'Bebida',
            'precio' => 12,
            'stock' => 30
        ]);

        Producto::create([
            'nombre' => 'Café Americano',
            'tipo' => 'Bebida',
            'precio' => 10,
            'stock' => 25
        ]);
    }
}