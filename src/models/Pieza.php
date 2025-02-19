<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pieza extends Model {
    protected $table = 'piezas';
    protected $fillable = ['nombre'];

    public function inventarios() {
        return $this->hasMany(Inventario::class, 'idPieza');
    }
}
