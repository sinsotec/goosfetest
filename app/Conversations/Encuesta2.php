<?php
namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use App\Models\Pregunta;


class Encuesta extends Conversation
{

    protected $nombre;
    protected $genero;
    protected $puntaje = 0;
    protected $preguntas = array(
        array("Sueles iniciar tus amistades por redes sociales o medios de internet?", 1), 
        array("Es frecuente que te decepciones de las personas que conoces?", 1),
        array("Te cuesta ser el centro de atención?", 1),
        array("Te es difícil comunicarle a los demás lo que sientes?", 1),
        array("Cuando tomas una decisión es fácil que te convenzan que cambie de parecer?", 1),
        array("Si en un restaurant te traen una orden equivocada, lo reclamarías?", 1),
        array("Si las otras personas toman decisiones, las sigues facilmente?", 1),
        array("Es más cómodo para ti, si la responsabilidad de liderar es de otra persona?", 1),
        array("Sueles pasar mucho tiempo en redes sociales?", 1),
        array("Si una persona te lastima, sueles pretender que no pasó nada para evitar mayores problemas?", 1)
    );
    protected $respuestas = array();
    protected $i;
    protected $pregunta;

    public function run()
    {
        $a = Pregunta::all();
        $this->say('Responde "si" o "no" a las siguientes preguntas, puedes terminar cuando quieras si escribes "salir"');
        $this->ask('Escribe si para comenzar.', function($answer){
            $this->i = 0;
            if($answer->getText() === 'si' or $answer->getText() === 'Si'){
                $this->Ego();
            }
        });
        
    }
    
    protected function Ego(){
        $this->pregunta = Question::create($this->preguntas[$this->i][0])->addButtons([Button::create('SI')->value('si'), Button::create('NO')->value('no'),]);
        $this->ask($this->pregunta, function($answer){
            //if($answer->getValue() != 'no' && $answer->getValue() != 'si' ){
            //    $this->say('debes contestar "si" o "no"');
            //    return $this->repeat($this->preguntas[$this->i][0]);
            //};
            if ($answer->getValue() == 'si') {
                    array_push($this->respuestas, $this->preguntas[$this->i][1]);
                    $this->puntaje += $this->preguntas[$this->i][1]; 
                };
            $this->i++;
            if(count($this->preguntas) > $this->i){
                $this->pregunta = Question::create($this->preguntas[$this->i][0])->addButtons([Button::create('SI')->value('si'), Button::create('NO')->value('no'),]);
                $this->repeat($this->pregunta);
                }else{
                    $this->say("Excelente!, dejame revisar tus respuestas...");
                    //sleep(2);
                    //$this->bot->typesAndWaits(3);
                    if($this->puntaje > 6){
                        $this->say("Tienes que tener cuidado con quien te relacionas, ya que tienes tendencia a ser presa facil para que las otras personas se aprovechen de ti o intenten engañarte. Sueles ser una persona sensible, es mas comodo y seguro para ti, si alguien más te apoya y te acompaña en lo que decidas. Nunca está demás pedir ayuda o tener herramientas que te apoyen en evitar ser manipulado o enganado.");
                    }else if($this->puntaje >3 && $this->puntaje < 7){
                        $this->say("Tienes poder de decisión, pero si te saben llevar lograran cambiar tu forma de pensar. Te recomendamos aplicar técnicas para aumentar la seguridad en ti mismo, no dependas de nadie, puedes lograr lo que te propongas. Sal a conocer gente nueva y nunca olvides ser precavido y recuerda que siempre estan a la mano herramientas de ayuda. ");
                    }else{
                        $this->say("Tienes una fuerza yoica bastante alta, gran seguridad en ti mismo y no es fácil manipularte. Eres una persona independiente y si te lo propones, preparado para liderar. Cuidado con el ego, podemos tener las mejores capacidades pero en este viaje llamado vida no se trata de competir y llegar más rápido, sino de saber utilizar las técnicas, ayudar a quien lo necesite y mantenerse disfrutando.");
                    }
                    $this->i = 0;
                };
        });
    }
}
