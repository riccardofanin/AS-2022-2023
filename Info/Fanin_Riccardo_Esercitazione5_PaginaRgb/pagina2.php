<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>


<body>
    
    <?php

        $red = $_POST['red'];
        $green = $_POST['green'];
        $blue = $_POST['blue'];

        $redHex = dechex($red);
        if (strlen($redHex)<2)
            $redHex = '0'.$redHex;

        $greenHex = dechex($green);
        if (strlen($greenHex)<2)
            $greenHex = '0'.$greenHex;

        $blueHex = dechex($blue);
        if (strlen($blueHex)<2)
            $blueHex = '0'.$blueHex;

        $color = "#" . $redHex . $greenHex . $blueHex;

        echo "
            <h1>$color</h1>

            <style>
                body{
                    background-color: rgb($red, $green, $blue);
                }

                h1{
                    padding-top: 23%;
                    padding-bottom: 23%;
                    text-align: center;
                }
            </style>
            ";

    ?>

</body>




</html>