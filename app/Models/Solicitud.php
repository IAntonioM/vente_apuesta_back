<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';

    protected $fillable = [
        'sub_id',
        'user_id',
        'numero_cuenta',
        'banco_id',
        'evidencia_file',
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
    public function tipoSolicitud()
    {
        return $this->belongsTo(TipoSolicitud::class, 'tipo_solicitud');
    }

    /**
     * Relación lógica: una solicitud pertenece a un estado
     */
    public function estadoSolicitud()
    {
        return $this->belongsTo(EstadoSolicitud::class, 'estado_solicitud');
    }

    /**
     * Relación lógica: una solicitud pertenece a un banco
     */
    public function banco()
    {
        return $this->belongsTo(Banco::class, 'banco_id');
    }

    /**
     * Relación lógica: una solicitud pertenece a un usuario
     */
    public function user()
    {
        return $this->belongsTo(Userss::class, 'user_id');
    }


}
