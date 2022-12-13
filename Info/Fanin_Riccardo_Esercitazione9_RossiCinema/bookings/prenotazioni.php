<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connect.php';

$show_id = [];
parse_str($_SERVER['QUERY_STRING'], $show_id);

$show_idnum = $show_id["show"];

if(isset($_POST['seat'])){
    prenota($show_idnum);
}

function film_info()
{
    global $db;
    global $show_id;
   

    $query="SELECT film_id FROM programmazione WHERE id='" . $show_id['show'] . "'";
    $film_id = $db->query($query)->fetch();
    
    $query="SELECT * FROM films WHERE id='" . $film_id['film_id'] . "'";
    $film = $db->query($query)->fetch();

    $str = "            
    <img class='object-cover w-full rounded-t-lg h-96 md:h-80 md:w-48 md:rounded-none md:rounded-l-lg' src='" . $film['poster'] . "' alt=''>
    <div class='flex flex-col justify-between ml-2 p-4 leading-normal'>
        <h5 class='mb-2 text-2xl font-bold tracking-tight text-[#fca311]'>" . $film['title'] . "</h5>
        <h6 class='mb-2 text-1xl font-bold tracking-tight text-[#fca311]'>" . $film['director'] . " - " . $film['runtime'] . " min </h6>
        <p class='mb-3 font-normal text-white'>" . $film['plot'] . "</p>
    </div>";

    return $str;
}

function seat_booked()
{
    global $db;
    global $show_id;

    $query="SELECT posti FROM prenotazioni WHERE spettacolo_id='" . $show_id['show'] . "'";
    $film_id = $db->query($query)->fetchAll();

    return json_encode($film_id);
}


// function prenota($spettacolo_id)
// {
//     global $db;

//     $posti = json_encode($_POST['seat']);
//     $user_id = '1';

//     // $user_id = $_SESSION['userID'];
//     // $spettacolo_id = $_SESSION['spettacoloID'];

//     $query = "INSERT INTO prenotazioni (user_id, spettacolo_id, posti) VALUES ('$user_id', '$spettacolo_id', '$posti')";
//     $result = $db->query($query);
// }

// function seatBooked($show_id)
// {
//     global $db;

//     $query="SELECT posti FROM prenotazioni WHERE spettacolo_id='" . $show_id . "'";
//     $result = $db->query($query)->fetchAll();

//     echo json_encode($result);
// }

// if(isset($_POST['submit'])){
//     prenota($show_id);
//     $costo = count($_POST['seat']) * 8;
//     ob_start();
//     header("Location: ../checkout/checkout.php?nTicket=" . $costo);
// }

function prenota($id)
{
    global $db;

    $posti = json_encode($_POST['seat']);
    $user_id = 1;
    $spettacolo_id = $id;

    // $user_id = $_SESSION['userID'];
    // $spettacolo_id = $_SESSION['spettacoloID'];

    $query = "INSERT INTO prenotazioni (user_id, spettacolo_id, posti) VALUES ('$user_id', '$spettacolo_id', '$posti')";
    $result = $db->query($query);
}


