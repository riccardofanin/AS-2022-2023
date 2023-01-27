<?php 
require_once('Pokeapi.php');
require_once('db.php');
class MessageHandler
{
    protected $command = '';
    protected $pokeapi, $db;
    protected $keyboard = [
        ['/pokedex'],
        ['/berries'],
        ['/types'],
    ];

    function __construct() {        
        $this->pokeapi = new Pokeapi();
        $this->db = new Database();
    }
    

    function handle($client, $message, $chatId)
    {
        global $client, $keyboard, $command;
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
                $response = $client->sendMessage([
                    'chat_id' => $chatId, 
                    'text' => $text, 
                    'reply_markup' => $reply_markup
                ]);
                return 0;

            case '/commandCount':
                $text = 'I comandi inseriti in questa chat sono: ' . $this->db->countCommands($chatId);
                $response = $client->sendMessage([
                    'chat_id' => $chatId, 
                    'text' => $text, 
                    'reply_markup' => $reply_markup
                ]);
                return 0;

            case '/pokedex':
                $command = $message;
                $text = [
                    'img' => 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/4d590121-e064-459f-99bd-27cf25d62415/dafne57-ed103009-a482-4125-ae9b-ead71084f705.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7InBhdGgiOiJcL2ZcLzRkNTkwMTIxLWUwNjQtNDU5Zi05OWJkLTI3Y2YyNWQ2MjQxNVwvZGFmbmU1Ny1lZDEwMzAwOS1hNDgyLTQxMjUtYWU5Yi1lYWQ3MTA4NGY3MDUucG5nIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmZpbGUuZG93bmxvYWQiXX0.8WlSqjnogNBfpi3B9rVuF7aBKRHvy13MWPdCnsrpOZE',
                    'content' => 'Inserisci il pokemon da cercare:'
                ]; 
                break;
    
            case '/berries':
                $command = $message;
                $text = [
                    'img' => 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/f0869a23-cb97-4f69-a18d-40b365af1450/deohtx3-fd8c8a1e-c1f0-47d9-af15-c279d0c8f906.jpg/v1/fill/w_1024,h_1024,q_75,strp/pokemon_berries_by_wildgirl91_deohtx3-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MTAyNCIsInBhdGgiOiJcL2ZcL2YwODY5YTIzLWNiOTctNGY2OS1hMThkLTQwYjM2NWFmMTQ1MFwvZGVvaHR4My1mZDhjOGExZS1jMWYwLTQ3ZDktYWYxNS1jMjc5ZDBjOGY5MDYuanBnIiwid2lkdGgiOiI8PTEwMjQifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.9lOWeICtLmcoDOsw1xkj2tOq-MktQ33hGW_bsCFOjgM',
                    'content' => 'Inserisci la bacca da cercare:'
                ]; 
                break;
    
            case '/types':
                $command = $message;
                $text = [
                    'img' => 'https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/i/4e5b0a48-a22e-48e1-92e8-c7b070383443/dde5bpj-c2cd65de-d02a-48e2-aa57-f51b11121d32.png',
                    'content' => 'Inserisci il tipo da cercare:'
                ]; 
                break;

            default:
                $text = $this->handleCommands($message, $chatId);
                break;
    
        }


        $response = $client->sendPhoto([
            'chat_id' => $chatId, 
            'photo' => $text['img'],
            'caption' => $text['content']
        ]);
        
    }

    function handleCommands($message, $chatId)
    {
        global $command;
        $data = '';

        if($command != "")
        {
            switch($command)
            {
                case '/pokedex':
                    $data = $this->pokeapi->pokedex($message);
                    break;
                case '/berries':
                    $data = $this->pokeapi->berries($message);
                    break;
                case '/types':
                    $data = $this->pokeapi->types($message);
                    break;
            }
            $this->db->insert($chatId, $command, $message);
        } 
        else
        {
            $data = [
                'img' => 'https://new-game-plus.fr/wp-content/uploads/2019/07/Game-Freak-Pikachu-KO.jpg',
                'content' => 'Inserisci un comando valido'
            ];
        }

        return $data;
    }
}