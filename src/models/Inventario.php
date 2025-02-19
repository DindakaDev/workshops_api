<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model {
    protected $table = 'inventario';
    protected $fillable = ['idTaller', 'idPieza', 'cantidad'];

    public function taller() {
        return $this->belongsTo(Taller::class, 'idTaller');
    }

    public function pieza() {
        return $this->belongsTo(Pieza::class, 'idPieza');
    }
}
