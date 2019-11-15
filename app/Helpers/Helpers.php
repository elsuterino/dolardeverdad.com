<?php

function getCurrency($key, $path = null){
    $data = Cache::get($key);

    if(!$path){
        return $data;
    }

    return collect($data)->get($path);
}
