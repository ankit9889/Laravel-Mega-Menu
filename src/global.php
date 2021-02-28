<?php

if (! function_exists('GetMenuByName')) {
function GetMenuByName($name)
{
    $file = $name;
    $destinationPath=storage_path('app/upload/menu_json/').'/';
    $getMenu = file_get_contents(storage_path('app/upload/menu_json/'.$name));
    $data = json_encode($getMenu, true);
     $decodedata = json_decode($getMenu);
    return collect($decodedata);
}
}


if (! function_exists('RemoveExtenstionFromFile')) {
    function RemoveExtenstionFromFile($file)
{
    $x = substr($file, 0, strrpos($file, '.'));
    return  $x;
}
}
