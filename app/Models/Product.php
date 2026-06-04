<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Súper importante: usar el modelo de MongoDB

class Product extends Model
{
    protected $connection = 'mongodb'; // Especifica la conexión NoSQL
    protected $collection = 'Productos'; // Tu colección exacta en Mongo
    protected $primaryKey = '_id'; // MongoDB usa _id de forma nativa

    // Campos que permitiremos rellenar al crear ropa
    protected $fillable = [
        'sku', 'nombre', 'precio', 'costo', 'categoria', 
        'temporada', 'activo', 'imagenes', 'variantes', 'tags', 'fecha_creacion'
    ];

    // Indicar que los campos de fecha se traten como instancias de Carbon en Laravel
    protected $casts = [
        'fecha_creacion' => 'datetime',
        'activo' => 'boolean',
    ];
}
