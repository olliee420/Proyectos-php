<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class InteraccionLead extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Interacciones_leads';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'usuario_id', 'producto_id', 'variante_solicitada', 
        'precio_momento', 'dispositivo', 'fecha'
    ];
}
