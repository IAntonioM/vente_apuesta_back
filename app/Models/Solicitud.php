<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'user_id',
        'tipo_solicitud',
        'estado_solicitud',
        'descripcion',
        'motivo_rechazo',
        'monto',
    ];

    public $timestamps = true;

    /**
     * Relación lógica: una solicitud pertenece a un tipo
     */
    public function tipo()
    {
        return $this->belongsTo(TipoSolicitud::class, 'tipo_solicitud');
    }

    /**
     * Relación lógica: una solicitud pertenece a un estado
     */
    public function estado()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_solicitud');
    }
}
