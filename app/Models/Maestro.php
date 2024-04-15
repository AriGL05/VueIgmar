<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;
    protected $table = 'maestros';
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
