<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model {
    protected $table = 'solicitud';
    protected $fillable = ['solicitud', 'idPieza', 'fecha_instalacion', 'estatus'];

    public function pieza() {
        return $this->belongsTo(Pieza::class, 'idPieza');
    }

    public function historial() {
        return $this->hasMany(HistorySolicitud::class, 'idSolicitud');
    }
}
