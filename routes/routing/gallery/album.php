<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Gallery\AlbumController;

Route::get('manage-album', [AlbumController::class, 'index'])->name('manage-album');
Route::get('manage-album/all-album', [AlbumController::class, 'allEducation'])->name('manage-album.all-album');
Route::post('manage-album/store', [AlbumController::class, 'store'])->name('manage-album.store');
Route::post('manage-album/delete', [AlbumController::class, 'delete'])->name('manage-album.delete');
Route::post('manage-album/edit', [AlbumController::class, 'edit'])->name('manage-album.edit');
Route::post('manage-album/update', [AlbumController::class, 'update'])->name('manage-album.update');
