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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codice Fiscale</title>

    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>

    <div class="title">
        <h1>CALCOLA IL TUO CODICE FISCALE!</h1>
    </div>

    <div class="container">
        <form action="script.php" method="post">
            <div class="sez first">
                <label for="cognome">Cognome:</label>
                <input type="text" name="cognome">

                <label for="nome">Nome:</label>
                <input type="text" name="nome">
            </div>

            <div class="sez second">
                <label for="luogo-nascita">Luogo di nascita:</label>
                <input type="text" name="luogo-nascita">

                <label for="sesso">Sesso:</label>
                <select name="sesso">
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>

            <div class="sez">
                <label for="data">Data di nascita:</label>
                <select name="data-giorno">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                </select>

                <select name="data-mese">
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>

                <select name="data-anno">
                    <option value="1900">1900</option>
                    <option value="1901">1901</option>
                    <option value="1902">1902</option>
                    <option value="1903">1903</option>
                    <option value="1904">1904</option>
                    <option value="1905">1905</option>
                    <option value="1906">1906</option>
                    <option value="1907">1907</option>
                    <option value="1908">1908</option>
                    <option value="1909">1909</option>
                    <option value="1910">1910</option>
                    <option value="1911">1911</option>
                    <option value="1912">1912</option>
                    <option value="1913">1913</option>
                    <option value="1914">1914</option>
                    <option value="1915">1915</option>
                    <option value="1916">1916</option>
                    <option value="1917">1917</option>
                    <option value="1918">1918</option>
                    <option value="1919">1919</option>
                    <option value="1920">1920</option>
                    <option value="1921">1921</option>
                    <option value="1922">1922</option>
                    <option value="1923">1923</option>
                    <option value="1924">1924</option>
                    <option value="1925">1925</option>
                    <option value="1926">1926</option>
                    <option value="1927">1927</option>
                    <option value="1928">1928</option>
                    <option value="1929">1929</option>
                    <option value="1930">1930</option>
                    <option value="1931">1931</option>
                    <option value="1932">1932</option>
                    <option value="1933">1933</option>
                    <option value="1934">1934</option>
                    <option value="1935">1935</option>
                    <option value="1936">1936</option>
                    <option value="1937">1937</option>
                    <option value="1938">1938</option>
                    <option value="1939">1939</option>
                    <option value="1940">1940</option>
                    <option value="1941">1941</option>
                    <option value="1942">1942</option>
                    <option value="1943">1943</option>
                    <option value="1944">1944</option>
                    <option value="1945">1945</option>
                    <option value="1946">1946</option>
                    <option value="1947">1947</option>
                    <option value="1948">1948</option>
                    <option value="1949">1949</option>
                    <option value="1950">1950</option>
                    <option value="1951">1951</option>
                    <option value="1952">1952</option>
                    <option value="1953">1953</option>
                    <option value="1954">1954</option>
                    <option value="1955">1955</option>
                    <option value="1956">1956</option>
                    <option value="1957">1957</option>
                    <option value="1958">1958</option>
                    <option value="1959">1959</option>
                    <option value="1960">1960</option>
                    <option value="1961">1961</option>
                    <option value="1962">1962</option>
                    <option value="1963">1963</option>
                    <option value="1964">1964</option>
                    <option value="1965">1965</option>
                    <option value="1966">1966</option>
                    <option value="1967">1967</option>
                    <option value="1968">1968</option>
                    <option value="1969">1969</option>
                    <option value="1970">1970</option>
                    <option value="1971">1971</option>
                    <option value="1972">1972</option>
                    <option value="1973">1973</option>
                    <option value="1974">1974</option>
                    <option value="1975">1975</option>
                    <option value="1976">1976</option>
                    <option value="1977">1977</option>
                    <option value="1978">1978</option>
                    <option value="1979">1979</option>
                    <option value="1980" selected="">1980</option>
                    <option value="1981">1981</option>
                    <option value="1982">1982</option>
                    <option value="1983">1983</option>
                    <option value="1984">1984</option>
                    <option value="1985">1985</option>
                    <option value="1986">1986</option>
                    <option value="1987">1987</option>
                    <option value="1988">1988</option>
                    <option value="1989">1989</option>
                    <option value="1990">1990</option>
                    <option value="1991">1991</option>
                    <option value="1992">1992</option>
                    <option value="1993">1993</option>
                    <option value="1994">1994</option>
                    <option value="1995">1995</option>
                    <option value="1996">1996</option>
                    <option value="1997">1997</option>
                    <option value="1998">1998</option>
                    <option value="1999">1999</option>
                    <option value="2000">2000</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                </select>
            </div>

            <input type="submit" id="sub-btn" value="CALCOLA!">

        </form>


        
    </div>

    <div class="result">
        <h2>IL TUO CODICE FISCALE : <?php echo main(); ?></h2>

    </div>


    <script src="script.php"></script>
</body>
</html>
