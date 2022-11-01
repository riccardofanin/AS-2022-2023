<?php 
    $alfabeto = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
    $vocali = ['A','E','I','O','U',' '];
    $consonanti = str_replace($vocali, '', $alfabeto);


    function main()
    {
        if ($_POST['cognome'] == "" or $_POST['nome'] == "" or $_POST['data-giorno'] == "" or $_POST['data-mese'] == "" or $_POST['sesso'] == "" or $_POST['data-anno'] == "" or $_POST['luogo-nascita'] == "")
        {
            printf( "INSERISCI I TUOI VALORI");
        }
        else
        {
            calcola();
        }
    }


    function calcola()
    {
        $codice = getCognome($_POST['cognome']) . getNome($_POST['nome']) . getData($_POST['data-giorno'], $_POST['data-mese'], $_POST['data-anno'], $_POST['sesso']) . getComune($_POST['luogo-nascita']);

        $codice .= getCodiceControllo($codice);

        echo $codice;
    }

    function getCognome($cognome)
    {
        $cognome = strtoupper($cognome);

        $vocaliCognome = str_replace($GLOBALS['consonanti'], '', $cognome);
        $consonantiCognome = str_replace($GLOBALS['vocali'], '', $cognome);

        if(strlen($consonantiCognome) >= 3)
        {
            return substr($consonantiCognome, 0, 3);
        }
        else if(strlen($cognome) < 3)
        {
            return str_pad($cognome, 3, "X");
        }
        else
        {
            return $consonantiCognome . substr($vocaliCognome, 0, 3 - strlen($vocaliCognome));
        }      

    }


    function getNome($nome)
    {
        $nome = strtoupper($nome);

        $vocaliNome = str_replace($GLOBALS['consonanti'], '', $nome);
        $consonantiNome = str_replace($GLOBALS['vocali'], '', $nome);
        
        if(strlen($consonantiNome) >= 4)
        {
            return $consonantiNome[0] . $consonantiNome[2] . $consonantiNome[3];
        }
        else if(strlen($consonantiNome) == 3)
        {
            return substr($consonantiNome, 0, 3);
        }
        else
        {
            return $consonantiNome . substr($vocaliNome, 0, 3 - strlen($consonantiNome));
        }
    }

    function getData($giorno, $mese, $anno, $sesso)
    {
        $letteraMesi = [
            "01" => "A",
            "02" => "B",
            "03" => "C",
            "04" => "D",
            "05" => "E",
            "06" => "H",
            "07" => "L",
            "08" => "M",
            "09" => "P",
            "10" => "R",
            "11" => "S",
            "12" => "T",
        ];

        if($sesso == "F")
        {
            $giorno += 40;
        }

        $annoCalcolato = substr($anno, -2, 2);

        $meseCalcolato = $letteraMesi[$mese];

        return $annoCalcolato . $meseCalcolato . $giorno;
    }


    function getComune($comune)
    {
        $str = file_get_contents('https://comuni-ita.herokuapp.com/api/comuni');   // API SCADE IL 28 NOVEMBRE IN CASO CAMBIARE CON IL FILE IN LOCALE (comuni.json)
        $listaComuni = json_decode($str, true); 

        for ($i=0; $i < count($listaComuni); $i++) { 
            if($listaComuni[$i]['nome'] == $comune)
            {
                return $listaComuni[$i]['codiceCatastale'];
            }
        }
    }

    function getCodiceControllo($codice)
    {
        $codicePari = "";
        $codiceDispari = "";
        $valorePari = 0;
        $valoreDispari = 0;

        $caratteriPari = [
            "0" => 1,
            "1" => 0,
            "2" => 5,
            "3" => 7,
            "4" => 9,
            "5" => 13,
            "6" => 15,
            "7" => 17,
            "8" => 19,
            "9" => 21,
            "A" => 1,
            "B" => 0,
            "C" => 5,
            "D" => 7,
            "E" => 9,
            "F" => 13,
            "G" => 15,
            "H" => 17,
            "I" => 19,
            "J" => 21,
            "K" => 2,
            "L" => 4,
            "M" => 18,
            "N" => 20,
            "O" => 11,
            "P" => 3,
            "Q" => 6,
            "R" => 8,
            "S" => 12,
            "T" => 14,
            "U" => 16,
            "V" => 10,
            "W" => 22,
            "X" => 25,
            "Y" => 24,
            "Z" => 23,
        ];

        $caratteriDispari = [
            "0" => 0,
            "1" => 1,
            "2" => 2,
            "3" => 3,
            "4" => 4,
            "5" => 5,
            "6" => 6,
            "7" => 7,
            "8" => 8,
            "9" => 9,
            "A" => 0,
            "B" => 1,
            "C" => 2,
            "D" => 3,
            "E" => 4,
            "F" => 5,
            "G" => 6,
            "H" => 7,
            "I" => 8,
            "J" => 9,
            "K" => 10,
            "L" => 11,
            "M" => 12,
            "N" => 13,
            "O" => 14,
            "P" => 15,
            "Q" => 16,
            "R" => 17,
            "S" => 18,
            "T" => 19,
            "U" => 20,
            "V" => 21,
            "W" => 22,
            "X" => 23,
            "Y" => 24,
            "Z" => 25,
        ];

        $resto = $GLOBALS['alfabeto'];

        for($i=0; $i < strlen($codice); $i++) { 
            if($i%2 == 0)
            {
                $codicePari .= $codice[$i];
            } 
            else
            {
                $codiceDispari .= $codice[$i];
            }
        }

        for($i=0; $i < strlen($codicePari); $i++) { 
            $valorePari += $caratteriPari[$codicePari[$i]];
        }

        for($i=0; $i < strlen($codiceDispari); $i++) { 
            $valoreDispari += $caratteriDispari[$codiceDispari[$i]];
        }

        return $resto[($valoreDispari+$valorePari)%26];
    }
?>
