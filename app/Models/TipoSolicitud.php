<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    use HasFactory;

    protected $table = 'tipos_solicitud';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public $timestamps = true;

    /**
     * Relación lógica: un tipo puede tener muchas solicitudes
     */
    public function solicitudes()
    {
        return $this->hasMany(Solicitud::class, 'tipo_solicitud');
    }
}
