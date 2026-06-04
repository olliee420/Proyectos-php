<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Usuario extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $connection = 'mongodb';
    protected $collection = 'Usuarios';
    protected $primaryKey = '_id'; // Llave primaria de MongoDB
    public $incrementing = false;  // Decirle a Laravel que no intente autoincrementar como SQL
    protected $keyType = 'int';    // Especificar que tus IDs sembrados son enteros (1, 2, 3)

    protected $fillable = [
        '_id', 'nombre', 'email', 'password', 'rol', 'fecha_creacion'
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Sobrescribir el método para que Laravel reconozca la contraseña 
     * guardada en texto plano o hash nativo sin problemas.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
}
