<?php
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (! function_exists('GetMenuByName')) {
function GetMenuByName($name)
{
    $path ='app/upload/menu_json/'.$name.'.json';
    if(File::exists(storage_path($path))){
        $getMenu = file_get_contents(storage_path($path));
        $data = json_encode($getMenu, true);
         $decodedata = json_decode($getMenu);
        return collect($decodedata);
    };
    return array('data not found');
}
}


if (! function_exists('RemoveExtenstionFromFile')) {
    function RemoveExtenstionFromFile($file)
{
    $x = substr($file, 0, strrpos($file, '.'));
    return  $x;
}
}
