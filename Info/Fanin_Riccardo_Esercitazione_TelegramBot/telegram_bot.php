<?php
require 'vendor/autoload.php';
require_once('MessageHandler.php');
use Telegram\Bot\Api;

// creazione dell'oggetto client
$client = new Api('5834320416:AAG3G8fmTZMGj_7JmmTrUQQcZ4saxEYEnRE');
$message_handler = new MessageHandler();
/* per l'attivazione del long polling memorizziamo
l'id dell'ultimo update elaborato */

$last_update_id=0;
while(true){
    // leggiamo gli ultimi update ottenuti
	$response = $client->getUpdates(['offset'=>$last_update_id, 'timeout'=>5]);
	if (count($response)<=0) continue;
	/* per ogni update scaricato restituiamo il messaggio
	sulla stessa chat su cui è stato ricevuto */
	foreach ($response as $r){
        $last_update_id=$r->getUpdateId()+1;
		$message=$r->getMessage();
		$chatId=$message->getChat()->getId();
		$text=$message->getText();
        $message_handler->handle($client,$text, $chatId);
	}
}
?>