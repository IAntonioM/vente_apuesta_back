<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'estados_solicitud';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public $timestamps = true;

    /**
     * Relación lógica: un estado puede tener muchas solicitudes
     */
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'estado_solicitud');
    }
}
