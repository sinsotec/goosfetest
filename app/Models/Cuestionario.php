<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function path()
    {
        return url('/cuestionarios/' . $this->id);
    }
    
    public function encuesta()
    {
        return $this->belongsTo(Encuesta::class);
    }
    
    public function preguntas()
    {
        return $this->hasMany(Pregunta::class);
    }

    public function conclusiones()
    {
        return $this->hasMany(Conclusiones::class);
    }
}
