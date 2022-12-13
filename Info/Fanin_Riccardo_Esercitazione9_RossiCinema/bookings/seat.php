<?php

require_once 'prenotazioni.php';

?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://cdn.tailwindcss.com"></script>
	<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">    
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../../style.css">
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
                    <a href="#" class="block py-2 pl-3 pr-4 text-white bg-black rounded md:bg-transparent md:text-white md:p-0 dark:text-white" aria-current="page">Accedi</a>
                    </li>
                    <li>
                    <a href="#" class="block py-2 pl-3 pr-4 text-white rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-black md:p-0 dark:text-white md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Registrati</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    

	<div class="flex items-center">
		<div class="mx-auto">
            <div class='flex flex-col items-center mx-auto my-10 border rounded-lg shadow-md md:flex-row md:max-w-xl hover:bg-black dark:border-black dark:bg-black dark:hover:bg-black''> 
                <?php echo film_info(); ?>
            </div>

			<h5 class='mb-10 text-2xl font-bold tracking-tight text-gray-900 dark:text-white'>SELEZIONA I POSTI CHE VUOI PRENOTARE</h5>

			<h4 class='mb-10 text-1xl font-bold tracking-tight text-gray-900 dark:text-white'>POSTI SELEZIONATI: </h4>
			<div id="seat-list"></div>


                <button id='sas' name='submit' value='true' class="mx-auto px-4 py-2 rounded-full text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:shadow-outline">
                    Prenota il tuo biglietto
                </button>
		</div>
		<div id="seating-chart" class="mx-auto">
			<img src="https://www.thespacecinema.it/assets/images/booking/screen-small.png" class="ml-2 my-9">

		</div>
	</div>
	


	<script src="script.js"></script>
</body>
</html>


