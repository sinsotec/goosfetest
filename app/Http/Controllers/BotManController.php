<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use App\Conversations\ExampleConversation;
use App\Conversations\Encuesta;

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
        $botman = app('botman');

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
    public function startConversation(BotMan $bot)
    {
        $bot->startConversation(new ExampleConversation());
    }
    
    public function startEncuesta(BotMan $bot)
    {
        $bot->startConversation(new Encuesta());
    }
}
