<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;

class Database{

    protected $capsule;

    function __construct()
    {
        $this->capsule = new Capsule();

        $this->capsule->addConnection([

            'driver'   => 'mysql',

            'host'     => 'localhost',

            'database' => 'telegram_bot',

            'username' => 'root',

            'password' => '',

            'charset'   => 'utf8',

            'collation' => 'utf8_unicode_ci',

            'prefix'   => '',

        ]);

        $this->capsule->setAsGlobal();

        $this->capsule->bootEloquent();
    }

    function insert($chatId, $command, $message)
    {
        $insert = Capsule::table('users')->insert(['chat_id' => $chatId,'command' => $command,'command_data' => $message]);
        //var_dump($users);
    }

    function countCommands($chatId)
    {
        $counter = Capsule::table('users')->select('*')->where('chat_id', '=', $chatId)->count();
        return $counter;
    }

}
