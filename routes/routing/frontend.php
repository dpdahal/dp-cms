<?php


use Illuminate\Support\Facades\Route;
use App\Models\Page\Menu;

Route::get('/', '\App\Http\Controllers\Frontend\ApplicationController@index')->name('index');

Route::group(['prefix' => 'blog'], function () {
    Route::get('/{slug?}', '\App\Http\Controllers\Frontend\BlogController@index')->name('blog');
    Route::any('blog-comment', '\App\Http\Controllers\Frontend\BlogController@blogComment')->name('blog-comment');
});

Route::get('contact', '\App\Http\Controllers\Frontend\ContactController@index')->name('contact');
Route::post('contact', '\App\Http\Controllers\Frontend\ContactController@store');


Route::get('faq', '\App\Http\Controllers\Frontend\ApplicationController@faq')->name('faq');
