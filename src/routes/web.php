<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>config('mvsoft.prefix')],function () {

    Route::get('/create/new/menu', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'NewMenu'])->name('NewMenu');
    Route::post('/store/new/menu', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'StoreNewMegaMenu'])->name('StoreNewMegaMenu');
    Route::get('/menu/list', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'MenuList'])->name('MenuList');
    Route::get('/menu/edit/{name}', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'MenuEdit'])->name('MenuEdit');
    Route::post('/menu/update/', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'MenuUpdate'])->name('MenuUpdate');
    Route::post('/menu/delete/', [Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'MenuDelete'])->name('MenuDelete');
// For Image Upload
Route::post('menu/upload-images', [ Mvsofttech\Megamenu\Http\Controllers\MegamenuController::class, 'MegaMenuImageUpload' ])->name('MegaMenuImageUpload');

});

