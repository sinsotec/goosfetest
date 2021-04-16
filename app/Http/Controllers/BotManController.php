<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\Encuesta;

use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Drivers\DriverManager;

class BotManController extends Controller
{
   /**
     * Place your BotMan logic here.
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */
    
    
     public function handle()
    {

        $config = [
             'web' => [
                'matchingData' => [
                    'driver' => 'web',
                ],
            ], 
            'telegram' => [
                'token' => '1264345809:AAFBC9uDExbae3q85avXsJ_cmri6X3c6s9k',
            ],
             'botman' => [
                'conversation_cache_time' => 10,
            ] 
        ];
        
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
        DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
        
        // Create an instance
        $botman = BotManFactory::create($config, new LaravelCache());

        $botman->hears('hola|Hola|HOLA', function ($bot){
            $bot->reply('Hola, si quieres iniciar una consulta, escribe: encuesta');
        });

        $botman->hears('salir', function ($bot){
            $bot->reply('Te has salido de la encuesta');
        })->stopsConversation();

        $botman->hears('ayuda|Ayuda', function ($bot){
            $bot->reply('Escribe salir para terminar una encuesta');
        })->skipsConversation();

        $botman->hears('encuesta|Encuesta', function ($bot){
            $this->startEncuesta($bot);
        });

        $botman->fallback(function($bot) {
            $message = $bot->getMessage();
            $bot->reply('Disculpa no comprendo "' . $message->getText() . '"');
            $bot->reply('Solo entiendo si escribes: hola, ayuda y encuesta');
        });

        $botman->listen();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tinker()
    {
        return view('tinker');
    }

    /**
     * Loaded through routes/botman.php
     * @param  BotMan $bot
     */
    
    public function startEncuesta(BotMan $bot)
    {
        $bot->startConversation(new Encuesta());
    }
}
