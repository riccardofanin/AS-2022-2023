<?php
session_start();

require_once 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>


    <title>Document</title>
</head>
<body>

    <div class="flex mt-40 mb-40 items-center justify-center">
        <form method="post">
            <input type="submit" name="run" value="GIOCA!" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"/><br/>
        </form>
    </div>

    <form action="" method="post">
        <div class="flex mt-40 mb-40 items-center justify-center">
            <div class="inline-flex shadow-md hover:shadow-lg focus:shadow-lg" role="toolbar">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="0" class="rounded-l inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="1" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="2" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="3" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="4" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="5" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="6" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="7" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="8" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                <input type="submit" <?php echo $disabled ?> name="btn" id="sub-btn" value="9" class="rounded-r inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase hover:bg-blue-800 focus:bg-blue-800 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
            </div>
        </div>
    </form>




    <div class="flex mt-40 mb-40 items-center justify-center">
        <?php 
            if(isset($_SESSION["is_started"]))
            {
                if(array_key_exists('btn',$_POST)){
                    partita();
                }
            }
        ?>
    </div>

</body>
</html>