<?php

namespace Mvsofttech\Megamenu\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MegamenuController extends Controller
{
    public function NewMenu()
    {
       return view('mvsoft::mega_menu.create');
    }

    public function StoreNewMegaMenu(Request $request)
    {
        $sample = [
       "text" =>  "About Mu",
       "href" =>  "http://home.com",
       "icon" =>  "",
       "target" =>  "_self",
       "title" =>  "",
       "image" =>  "http://127.0.0.1:8000/upload/mega_menu/images/161402097626961125-679d-494e-9fc7-43b9d1249995.jpg"
        ];
       $data = json_encode([$sample]);
       $file = Str::slug($request->menu_name).'.json';
       $destinationPath=storage_path("app/upload/menu_json/");
       if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
      $put = File::put($destinationPath.$file,$data);
      $getMenu = File::get($destinationPath.$file);
      $data = json_encode($getMenu, true);
       $decodedata = json_decode($getMenu);
       $name = $file;
       return redirect(route('MenuEdit',$file));
    }

    public function MenuList()
    {
        if(File::exists(storage_path('app/upload/menu_json/'))){
            $path = storage_path('app/upload/menu_json/');
        }
       $files = (isset($path)) ? File::allfiles($path) : array() ;
       return view('mvsoft::mega_menu.list',compact('files'));
    }

    public function MenuEdit($name)
    {
       $file = $name;
       $destinationPath=storage_path('app/upload/menu_json/').'/';
       $getMenu = file_get_contents(storage_path('app/upload/menu_json/'.$name));
       $data = json_encode($getMenu, true);
        $decodedata = json_decode($getMenu);
       return view('mvsoft::mega_menu.edit',compact('decodedata','data','name'));
    }

    public function MenuUpdate(Request $request)
    {
    $jsonString = $request->jsonMenu;
    $data = json_decode($jsonString, true);
    $newJsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents(storage_path('/app/upload/menu_json/'.$request->file_name), stripslashes($newJsonString));
   return response(['success' => 'Menu Saved !']);
    }


   public function MegaMenuImageUpload(Request $request)
   {
    if ($request->hasfile('file')) {
        $image = $request->file;
        $imageName = time() . $image->getClientOriginalName();
        $pathimg = 'upload/mega_menu/images/'.$imageName;
        $image->move('upload/mega_menu/images/', $imageName);
        $path = 'upload/mega_menu/images/' . $imageName;
        $ImageURL =asset('upload/mega_menu/images/' . $imageName);
    }

      return response(['ImageUrl' => $ImageURL]);
   }

   public function MenuDelete(Request $request)
   {
       $destinationPath='/app/upload/menu_json/'.$request->name;
       if(File::exists(storage_path($destinationPath))){
           File::delete(storage_path($destinationPath));
           }
       return 'Done';
   }
}
