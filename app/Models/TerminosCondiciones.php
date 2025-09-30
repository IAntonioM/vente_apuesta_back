<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerminosCondiciones extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'terms_and_conditions';

    // Clave primaria
    protected $primaryKey = 'id';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'version',
        'content',
        'estado',
    ];

    // Laravel ya maneja created_at y updated_at
    public $timestamps = true;
}
