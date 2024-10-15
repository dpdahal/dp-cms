<?php

use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'manage-address'], function () {
    Route::resource("continents","\App\Http\Controllers\Backend\Address\ContinentController");
    Route::resource("countries","\App\Http\Controllers\Backend\Address\CountryController");

});
