<?php
use App\Http\Controllers\BotManController;
use App\Conversations\Encuesta;
use BotMan\Drivers\Telegram\TelegramDriver;


//Probando diferencias entre app y resolve

//$botman=app('botman'); Funciona al igual que resolve, aun se estan probando

$botman = resolve('botman'); //Funciona al igual que app, aun se estan probando

//---------------------------------------------------------------------------------------

//$botman->say('Hola soy GooSFe, como puedo ayudarte?', '');
//$botman->say('holasdfasdfa', '412668735', TelegramDriver::class);
//$botman->say('Si no sabes que decir, puedes escribir "ayuda"', '');

$botman->hears('foo', function ($bot){
    $bot->reply('bar');
});

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');
});
$botman->hears('Start conversation', BotManController::class.'@startConversation');

//contenido de goosfe viejo

$botman->fallback(function($bot) {
    $message = $bot->getMessage();
    $bot->reply('Disculpa no comprendo "' . $message->getText() . '"');
    $bot->reply('Solo entiendo si escribes: hola, ayuda y encuesta');
});

 $botman->hears('encuesta', BotManController::class.'@startEncuesta'); //Usando el controlador
/* $botman->hears('encuesta', function ($bot){
    $bot->startConversation(new App\Conversations\Encuesta);
}); */ //Iniciando la conversacion sin el controlador


$botman->hears('ayuda', function ($bot){
    $bot->typesAndWaits(2);
    $bot->reply('Hola, por ahora solo comprendo si escribes: hola, ayuda y encuesta');
})->skipsConversation();

$botman->hears('hola', function ($bot){
    $bot->reply('Hola, si quieres iniciar una consulta, escribe: encuesta');
});

/* function enviar(){
    $botman->say('holasdfasdfa', '412668735', TelegramDriver::class);
} */

$botman->hears('mi numero', function ($bot){
    //$botman->getSender();
    $user = $bot->getUser()->getId();
    //$GLOBALS['botman']->say('holasdfasdfa', '412668735', TelegramDriver::class);
    //$id = $user->getUsername();
    $bot->reply('asjkdfjkalsdjlkfasdf');
    $bot->typesAndWaits(2);
    //enviar();
});

$botman->hears('salir', function ($bot){
    $bot->reply('Te has salido de la encuesta');
})->stopsConversation();


//contenido de goosfe viejo