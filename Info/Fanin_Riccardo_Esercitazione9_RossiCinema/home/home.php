<?php

require_once 'films.php';

session_start();

$_SESSION['show-list'] = [];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">



    <title>The Rossi Cinema</title>
</head>
<body>

    <!--- NAVBAR --->

    <nav class="bg-black border-gray-200 px-2 sm:px-4 py-2.5 dark:bg-black">
        <div class="container flex flex-wrap items-center justify-between mx-auto">
            <a href="https://www.thespacecinema.it/" class="flex items-center">
                <img src="https://cdn1.thespacecinema.it/-/media/images/header/italy/the-space-cinema-it-4.jpg?h=60&la=it-IT&w=292" class="h-6 mr-3 sm:h-9" alt="Flowbite Logo" />
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-[#fca311] md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-[#fca311] dark:bg-[#fca311] md:dark:bg-[#fca311] dark:border-gray-700">
                    <li>
                    <a href="client/auth/login.html" class="block py-2 pl-3 pr-4 text-white bg-black rounded md:bg-transparent md:text-white md:p-0 dark:text-white" aria-current="page">Accedi</a>
                    </li>
                    <li>
                    <a href="client/auth/register.html" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 dark:text-white md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Registrati</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!--- Film disponibili --->
    <?php generate_card(); ?>
    

</body>
</html>