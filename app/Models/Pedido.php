<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'cliente',
        'cantidad',
        'total',
        'estado',
        'producto_id'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}