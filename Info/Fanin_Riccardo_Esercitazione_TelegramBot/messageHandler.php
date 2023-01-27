<?php 
require_once('pokeapi.php');
class MessageHandler
{
    protected $command = '';
    protected $pokeapi;
    protected $keyboard = [
        ['/pokedex'],
        ['/berries'],
        ['/types'],
    ];

    function __construct() {
        $pokeapi = new Pokeapi();
    }
    

    function handle($client, $message, $chatId)
    {
        global $pokeapi, $client, $keyboard, $command;
        $text = '';
        $reply_markup = null;
        //var_dump($message);
    
        switch($message)
        {
            case '/start':
                $text = 'Scegliere azione';
                $reply_markup = $client->replyKeyboardMarkup([
                    'keyboard' => [
                        ['/pokedex'],
                        ['/berries'],
                        ['/types'],
                    ], 
                    'resize_keyboard' => true, 
                    'one_time_keyboard' => true
                ]);
                break;
    
            case '/pokedex':
                $command = $message;
                $text = "Inserisci il pokemon da cercare: "; 
                break;
    
            case '/berries':
                $command = $message;
                $text = "Inserisci la bacca da cercare: "; 
                break;
    
            case '/types':
                $command = $message;
                $text = "Inserisci il tipo da cercare: "; 
                break;
    
            default:
                $text = $this->handleCommands($message);
                break;
    
        }
    
        $response = $client->sendMessage([
            'chat_id' => $chatId, 
            'text' => $text, 
            'reply_markup' => $reply_markup
        ]);
    }

    function handleCommands($message)
    {
        global $pokeapi, $command;

        if($command != "")
        {
            switch($command)
            {
                case '/pokedex':
                    return $pokeapi->pokedex($message);
                case '/berries':
                    return $pokeapi->berries($message);
                case '/types':
                    return $pokeapi->types($message);
            }
        } 
        else
        {
            return "Inserisci un comando valido";
        }
    }
}