<?php

class Pokeapi
{
    function pokedex($pkmn){
        $final_url = "https://pokeapi.co/api/v2/pokemon/" . $pkmn;
        $data = file_get_contents($final_url);
        $json = json_decode($data);

        $message = $json->name;
        return $message;
    }

    function berries($berry)
    {
        $final_url = "https://pokeapi.co/api/v2/berry/" . $berry;
        $data = file_get_contents($final_url);
        $json = json_decode($data);

        $message = $json->item->name;
        return $message;
    }

    function types($type)
    {
        $final_url = "https://pokeapi.co/api/v2/type/" . $type;
        $data = file_get_contents($final_url);
        $json = json_decode($data);

        $message = $json->name;
        return $message;
    }
}