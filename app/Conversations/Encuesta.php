<?php
namespace App\Conversations;

use App\Models\Conclusiones;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

use App\Models\Cuestionario;

class Encuesta extends Conversation
{
    
    protected $puntaje = 0;
    protected $preguntas = array();
    protected $respuestas = array();
    protected $cuestionario;
    protected $pregunta;
    protected $posicionCuestionario;
    protected $posicionPregunta;
    protected $posicionRespuesta;
    protected $conclusiones = array();

    public function run()
    {
        $this->say('Me alegra que quieras hacer una encuesta, dejame mostrarte algunas.');
            $this->elegirCuestionarios(Cuestionario::where('activo', 1)->get());
    }

    protected function elegirCuestionarios($cuestionarios){
            if(count($cuestionarios) == 0){
                $this->say('Oops! al parece no tengo ninguna disponible.');
            }else{$this->pregunta = Question::create('Elige una encuesta:');
                foreach ($cuestionarios as $key => $cuestionario){
                    $this->pregunta->addButtons(
                        [
                            Button::create($cuestionario->titulo)->value($key),
                        ]);
                };
                $this->ask($this->pregunta, function($answer) use ($cuestionarios){
                    $this->posicionPregunta = 0;
                    $this->cuestionario = $cuestionarios[$answer->getText()]->load('preguntas.respuestas');
                    $this->preguntas = $this->cuestionario->preguntas;
                    if(count($this->preguntas) > 0){
                        $this->hacerPreguntas();
                    }else{
                        $this->say('Oops! este cuestionario no tiene preguntas.');
                    }
                });
            };
    }

    protected function hacerPreguntas(){
        $this->pregunta = Question::create($this->preguntas[$this->posicionPregunta]->pregunta);
        $this->generarRespuestas();
        $this->ask($this->pregunta, function($answer){
            $this->posicionPregunta++;
            $this->puntaje += intval($answer->getText());
            if(count($this->preguntas) > $this->posicionPregunta){
                $this->pregunta = Question::create($this->preguntas[$this->posicionPregunta]->pregunta);
                $this->generarRespuestas();
                $this->repeat($this->pregunta);
            }else{
                $this->say($this->mostrarConclusiones());
            };
         });
    }

    protected function generarRespuestas(){
        $this->respuestas = $this->preguntas[$this->posicionPregunta]->respuestas;
        foreach($this->respuestas as $respuesta){
            $this->pregunta->addButtons([
                Button::create($respuesta->respuesta)->value($respuesta->puntaje),
            ]); 
        };
    }

    protected function mostrarConclusiones(){
        $cuestionario = $this->cuestionario->load('conclusiones');
        return  $this->buscarConclusion($cuestionario->conclusiones->sortByDesc('puntuacion_min')->values());
    }

    protected function buscarConclusion($conclusiones){        
        foreach ($conclusiones as $conclusion){
             if($this->puntaje >= $conclusion->puntuacion_min){
                return $conclusion->conclusion;
            } 
        }
    }
}

