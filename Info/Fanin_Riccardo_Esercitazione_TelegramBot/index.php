<?php

$api_url = 'https://pokeapi.co/api/v2/pokemon/ditto';

$json_data = file_get_contents($api_url);

echo $json_data;

?>