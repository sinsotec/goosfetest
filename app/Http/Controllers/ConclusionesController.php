<?php

namespace App\Http\Controllers;

use App\Models\Conclusiones;
use Illuminate\Http\Request;
use App\Models\Cuestionario;

class ConclusionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Cuestionario $cuestionario)
    {

        $cuestionario->load('conclusiones');

        //dd($cuestionario);

        return view('conclusiones.show', compact('cuestionario'));
    }

    public function create(Cuestionario $cuestionario)
    {
        //$puntuacion_max = Conclusiones::where('cuestionario_id', $cuestionario->id)->max('puntuacion_max');
        
        return view('conclusiones.create', compact('cuestionario'));
    }

    public function store(Cuestionario $cuestionario, Request $request)
    {
        
        $data = request()->validate([
            'conclusion.conclusion' => 'required',
            'conclusion.puntuacion_min' => 'required',
        ]);
        
        
        $conclusiones = Conclusiones::where('cuestionario_id', $cuestionario->id)
                                    ->where('puntuacion_min', $data['conclusion']['puntuacion_min'])->get();

        if(count($conclusiones) != 0){
            return redirect('/cuestionarios/'.$cuestionario->id . '/conclusiones/create')->withErrors([
                "conclusion.puntuacion_min" => "Ya existe ese puntaje!"
            ]);
        }else{
            $cuestionario->conclusiones()->create($data['conclusion']);
            return redirect('/cuestionarios/'.$cuestionario->id . '/conclusiones');
        }

    }

    public function edit(Cuestionario $cuestionario, Conclusiones $conclusion)
    {
        
       return view('conclusiones.edit', compact('cuestionario', 'conclusion'));
    }

    public function update(Cuestionario $cuestionario, Conclusiones $conclusion)
    {
        
        $data = request()->validate([
            'conclusion.conclusion' => 'required',        
            'conclusion.puntuacion_min' => 'required',        
        ]);

        $conclusiones = Conclusiones::where('cuestionario_id', $cuestionario->id)
                        ->where('puntuacion_min', $data['conclusion']['puntuacion_min'])->get();

        if($conclusion->puntuacion_min != $data['conclusion']['puntuacion_min']){
            if(count($conclusiones) != 0){
                return redirect('/cuestionarios/'.$cuestionario->id . '/conclusiones/' .$conclusion->id. '/edit')->withErrors([
                "conclusion.puntuacion_min" => "Ya existe ese puntaje!"
            ]);
            }
        }
        $conclusion->update($data['conclusion']);
        return redirect('/cuestionarios/'.$cuestionario->id . '/conclusiones');

    }

    public function destroy(Cuestionario $cuestionario, Conclusiones $conclusion)
    {
    
       $conclusion->delete();
      return redirect('/cuestionarios/'. $cuestionario->id . '/conclusiones');
    }

}
