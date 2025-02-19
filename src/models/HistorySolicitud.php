<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class HistorySolicitud extends Model {
    protected $table = 'history_solicitud';
    protected $fillable = ['idTaller', 'idSolicitud', 'idStatus', 'fecha_cambio', 'lat', 'lng'];

    public function solicitud() {
        return $this->belongsTo(Solicitud::class, 'idSolicitud');
    }

    public function status() {
        return $this->belongsTo(Status::class, 'idStatus');
    }

    public function taller() {
        return $this->belongsTo(Taller::class, 'idTaller');
    }
}
