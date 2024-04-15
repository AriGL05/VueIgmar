<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    use HasFactory;
    protected $table = 'materias';
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carrera_id');
    }
    public function maestros()
    {
        return $this->hasMany(Maestro::class);
    }

}
