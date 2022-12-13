<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/db_connect.php';

$film_list = [];
$show_list = [];
get_film();

function get_film()
{
    global $db;
    global $film_list;

    $result = $db->query("SELECT COUNT(*) FROM films");
    $num_rows = $result->fetchColumn();

    for($i = 1; $i <= $num_rows; $i++)
    {
        $sql = "SELECT * FROM films where id='". $i ."'";
        $result = $db->query($sql)->fetch();
        
        array_push($film_list, $result);
    }
}

function film_info($film)
{
    $str = "            
    <img class='object-cover w-full rounded-t-lg h-96 md:h-80 md:w-48 md:rounded-none md:rounded-l-lg' src='" . $film['poster'] . "' alt=''>
    <div class='flex flex-col justify-between ml-2 p-4 leading-normal'>
        <h5 class='mb-2 text-2xl font-bold tracking-tight text-[#fca311]'>" . $film['title'] . "</h5>
        <h6 class='mb-2 text-1xl font-bold tracking-tight text-[#fca311]'>" . $film['director'] . " - " . $film['runtime'] . " min </h6>
        <p class='mb-3 font-normal text-white'>" . $film['plot'] . "</p>
    </div>";

    return $str;
}

function show_info($film_id)
{
    global $db;
    $str = '';

    
    $num_rows = $db->query("SELECT COUNT(*) FROM programmazione where film_id='". $film_id ."'")->fetchColumn();
    $sql = "SELECT * FROM programmazione WHERE film_id='" . $film_id . "'";
    $result = $db->query($sql)->fetchAll();

    if(count($_SESSION['show-list']) <= 0)
    {
        $_SESSION['show-list'] = array_merge($_SESSION['show-list'], $result);
    }


    for($i = 0; $i < $num_rows; $i++)
    {
        $str .= 
        "
        <button name='show' value=".$result[$i]['id'] . " id='".$result[$i]['id'] . "' onclick='setId(this)' class='flex m-4 text-white border border-[#fca311] rounded hover:bg-[#fca311] hover:text-black leading-normal'>
            <div class='show-list text-center text-xs px-4 my-2'>
                <div>" . $result[$i]['data'] . "</div><div>" . $result[$i]['orario'] . "</div>
            </div>
        </button>";
    }

    return $str;

}

function generate_card()
{
    global $film_list;

    for($i = 0; $i < count($film_list); $i++)
    {
        echo
            "<div class='flex flex-col items-center mx-auto my-10 border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-black dark:border-black dark:bg-black dark:hover:bg-black''> "
            . film_info($film_list[$i]) .  "<div id='shows' class='relative'><form action='films.php' method='post'>". show_info($film_list[$i]['id']) . "</form></div>" .
            "</div>";
    }
}


if(isset($_POST['show'])){
    ob_start();
    header("Location: ../bookings/seat.php?show=" . $_POST['show']);
}