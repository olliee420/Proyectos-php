<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Producto extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'Productos';
    protected $primaryKey = '_id';

    protected $fillable = [
        '_id', 'sku', 'nombre', 'precio', 'costo', 'categoria', 
        'temporada', 'activo', 'imagenes', 'variantes', 'tags', 'fecha_creacion'
    ];
}
