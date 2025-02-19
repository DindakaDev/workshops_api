<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model {
    protected $table = 'talleres';
    protected $fillable = ['nombre', 'lat', 'lng'];
}
