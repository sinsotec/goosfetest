<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuestionario;
use App\Models\Pregunta;

class PreguntaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create(Cuestionario $cuestionario)
    {
        return view('pregunta.create', compact('cuestionario'));
    }

    public function store(Cuestionario $cuestionario)
    {
        $data = request()->validate([
            'pregunta.pregunta' => 'required',        
        ]);

       $pregunta = $cuestionario->preguntas()->create($data['pregunta']);
        
       return redirect('/cuestionarios/'.$cuestionario->id);
    }

    public function edit(Pregunta $pregunta)
    {
        
       return view('pregunta.edit', compact('pregunta'));
    }

    public function update(Pregunta $pregunta)
    {
        
        $data = request()->validate([
            'pregunta' => 'required',        
        ]);

       $pregunta->update($data);
        
       return redirect('/cuestionarios/'.$pregunta->cuestionario_id);
    }

    public function destroy(Pregunta $pregunta)
    {
        $cuestionario_id =  $pregunta->cuestionario_id;
        $pregunta->delete();
       return redirect('/cuestionarios/'. $pregunta->cuestionario_id);
    }

}
