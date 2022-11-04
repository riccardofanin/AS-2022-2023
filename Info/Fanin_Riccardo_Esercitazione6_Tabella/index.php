<?php 

    function genTable($righe, $colonne, $colore)
    {
        $tabella = "";
        for ($i=0; $i < $righe; $i++) { 
            $tabella .= "<tr>";
            for ($c=0; $c < $colonne; $c++) {

                $colore1 = (string) rand(0, 255);
                $colore2 = (string) rand(0, 255);
                $colore3 = (string) rand(0, 255);

                if($colore == "true")
                {
                    $tabella .= '<td style="background-color:rgb(' . $colore1 . ',' . $colore2 . ',' . $colore3 .');"> </td>';
                } 
                else
                {
                    $tabella .= '<td> </td>';
                }
                
            }
            $tabella .= "</tr>";
        }

        return $tabella;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="">
        <label for="tRighe">Righe: </label>
        <input type="number" name="tRighe" min="0">
        <label for="tColonne">Colonne </label>
        <input type="number" name="tColonne" min="0">

        <select name="colore">
            <option value="true">si</option>
            <option value="false">no</option>
        </select>

        <input type="submit" value="Invia">
    </form>

    <table>
        <?php
            if($_POST)
            {
                echo genTable($_POST['tRighe'], $_POST['tColonne'], $_POST['colore']);
            }
        ?>
    </table>
</body>
</html>

