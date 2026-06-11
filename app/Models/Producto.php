<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'tipo',
        'precio',
        'stock'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}