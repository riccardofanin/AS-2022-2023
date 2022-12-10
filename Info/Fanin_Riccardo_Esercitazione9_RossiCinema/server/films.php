<?php

require_once "db_connect.php";

$film_list = [];
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

function generate_card()
{
    global $film_list;

    for($i = 0; $i < count($film_list); $i++)
    {
        echo "
        <a href='#' class='flex flex-col my-100 items-center md:my-100 bg-white border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700'>
            <img class='object-cover w-full rounded-t-lg h-96 md:h-80 md:w-48 md:rounded-none md:rounded-l-lg' src='" . $film_list[$i]['poster'] . "' alt=''>
            <div class='flex flex-col justify-between p-10 leading-normal'>
                <h5 class='mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white'>" . $film_list[$i]['title'] . "</h5>
                <h6 class='mb-2 text-1xl font-bold tracking-tight text-gray-900 dark:text-white'>" . $film_list[$i]['director'] . " - " . $film_list[$i]['runtime'] . " min </h6>
                <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'>" . $film_list[$i]['plot'] . "</p>
            </div>
        </a>";
    }
}

// function generate_carousel() // sospeso
// {
//     global $film_list;

//     $string = "";

//     for($i = 0; $i < count($film_list); $i++)
//     {
//         echo "        <div class='carousel-item active relative float-left w-full'>
//         <img
//             src='https://mdbootstrap.com/img/Photos/Slides/img%20(15).jpg'
//             class='block w-full'
//             alt='...'
//         />
//         <div class='carousel-caption hidden md:block absolute text-center'>
//             <h5 class='text-xl'>First slide label</h5>
//             <p>Some representative placeholder content for the first slide.</p>
//         </div>
//         </div>";
//     }


// }