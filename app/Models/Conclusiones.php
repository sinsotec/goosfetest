<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conclusiones extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class);
    }
    
}
