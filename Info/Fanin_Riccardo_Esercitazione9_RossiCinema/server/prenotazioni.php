<?php

require_once 'db_connect.php';

function prenota()
{
    global $db;

    $posti = json_encode($_POST['seat']);
    $user_id = '1';
    $spettacolo_id = '2';

    // $user_id = $_SESSION['userID'];
    // $spettacolo_id = $_SESSION['spettacoloID'];

    $query = "INSERT INTO prenotazioni (user_id, spettacolo_id, posti) VALUES ('$user_id', '$spettacolo_id', '$posti')";
    $result = $db->query($query);
}

if(isset($_POST['seat'])){
    prenota();
}