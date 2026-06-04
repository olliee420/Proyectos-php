<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class OrdenManual extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Ordenes_manuales';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'usuario_id', 'cliente', 'items', 'total', 
        'metodo_envio', 'estado', 'fecha'
    ];
}
