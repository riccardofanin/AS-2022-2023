<?php

class Pokeapi
{
    function pokedex($pkmn){
        $final_url = "https://pokeapi.co/api/v2/pokemon/" . $pkmn;
        $desc_url =  "https://pokeapi.co/api/v2/pokemon-species/" . $pkmn;
        $data = file_get_contents($final_url);
        $json = json_decode($data);

        $data_desc = file_get_contents($desc_url);
        $json_desc = json_decode($data_desc);

        $desc = $json_desc->flavor_text_entries[1]->flavor_text;
        $desc = str_replace("\n", ' ', $desc);
        var_dump($desc);
        $img = $json->sprites->other->home->front_default;
        $name = $json->name;
        
        $message = [
            'img' => $img,
            'content' => 'Name: ' . $name . "\nDescription: " . $desc,
        ];
        return $message;
    }

    function berries($berry)
    {
        $berry_url = "https://pokeapi.co/api/v2/berry/" . $berry;
        $berry_data = file_get_contents($berry_url);
        $berry_json = json_decode($berry_data);

        $item_url = $berry_json->item->url;
        $item_data = file_get_contents($item_url);
        $item_json = json_decode($item_data);

        $desc = $item_json->effect_entries[0]->effect;
        $desc = str_replace("\n", ' ', $desc);

        $message = [
            'img' => $item_json->sprites->default,
            'content' => 'Name: ' . $berry_json->item->name . "\nDescription: " . $desc,
        ];
        return $message;
    }

    function types($type)
    {
        $final_url = "https://pokeapi.co/api/v2/type/" . $type;
        $data = file_get_contents($final_url);
        $json = json_decode($data);

        // double_damage_from
        // double_damage_to
        // half_damage_from
        // half_damage_to
        // no_damage_from
        // no_damage_to

        $message = [
            'img' => 'https://cnt-02.content-eu.drive.amazonaws.com/cdproxy/templink/I40B389bMN21jtwpnxWbTEEFCxYiyU4_c5046GHsLeoeJxFPc?viewBox=1406%2C937',
            'content' => 'Name: ' . $json->name,
        ];;
        return $message;
    }
}