<?php

$disabled = "disabled='disabled'";

function carica_tesoro()
{
    $giardino = [0,0,0,0,0,0,0,0,0,0];

    $tesori = 0;

    while($tesori < 2)
    {
        $index = rand(0, 9);

        if($giardino[$index] == 0)
        {
            $giardino[$index] = 1;
            $tesori++;
        }
    }

    return $giardino;
}

function setup()
{
    $_SESSION["giardino"] = carica_tesoro();
    $_SESSION["tentativi"] = 3;
    $_SESSION["tesori"] = 0;

    $_SESSION["is_started"] = true;
}

$disabled;

if(array_key_exists('run',$_POST)){
    if(!isset($_SESSION["is_started"]))
    {
        setup();
    }
}

function partita()
{
    global $disabled;
    $button_id_1 = intval($_POST['btn']);

    if($_SESSION["tentativi"] > 1)
    {
        if($_SESSION["giardino"][$button_id_1] == 1)
        {
            if($_SESSION["tesori"] < 1)
            {
                echo "Hai trovato il primo tesoro!";
                $_SESSION["tesori"] = $_SESSION["tesori"] + 1;
            }
            else
            {
                echo "Hai vinto!";

                session_unset();
            }

        }
        else
        {
            $_SESSION["tentativi"] = $_SESSION["tentativi"] - 1;
            echo "Hai sbagliato, ti rimangono ancora " . $_SESSION["tentativi"] . " tentativi."; 
        }
    }
    else
    {
        $disabled = "disabled='disabled'";
        echo "Tentativi esauriti!";     
      
        session_unset();
    }
}

if(!isset($_SESSION["is_started"]))
{
    $disabled = "disabled='disabled'";
}
else
{
    $disabled = "";
}





 
