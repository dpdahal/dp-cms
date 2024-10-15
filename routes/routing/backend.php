<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Dashboard\DashboardController;
use App\Http\Controllers\Backend\Ckeditor\CkeditorController;
use App\Http\Controllers\Backend\Ajax\AjaxController;


Route::group(['namespace' => 'Backend', 'prefix' => 'company-backend', 'middleware' => ['auth', 'verified']], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/contact-list', [DashboardController::class, 'contact'])->name('contact-list');
    Route::get('/contact-delete/{id}', [DashboardController::class, 'deleteContact'])->name('contact-delete');
    Route::get('/resume-list', [DashboardController::class, 'resume_list'])->name('resume-list');
    Route::get('/resume-delete/{id}', [DashboardController::class, 'deleteResume'])->name('resume-delete');

    require_once dirname(__FILE__) . '/role/role.php';
    require_once dirname(__FILE__) . '/permission/permission.php';
    require_once dirname(__FILE__) . '/account/account-type.php';
    require_once dirname(__FILE__) . '/account/admin.php';
    require_once dirname(__FILE__) . '/profile/profile.php';
    require_once dirname(__FILE__) . '/member-type/member-type.php';
    require_once dirname(__FILE__) . '/team/team.php';
    require_once dirname(__FILE__) . '/activity/activity.php';
    require_once dirname(__FILE__) . '/address/address.php';
    require_once dirname(__FILE__) . '/gallery/album.php';

//    Route::resource('manage-album', "\App\Http\Controllers\Backend\Gallery\AlbumController");
    Route::resource('manage-media', "\App\Http\Controllers\Backend\Gallery\GalleryController");
    Route::any('add-media-file', "\App\Http\Controllers\Backend\Gallery\GalleryController@addMediaFile")->name('add-media-file');
    Route::any('delete-all-media-files', "\App\Http\Controllers\Backend\Gallery\GalleryController@deleteAll")->name('delete-all-media-files');
    Route::get('media-delete-by-id/{id?}', "\App\Http\Controllers\Backend\Gallery\GalleryController@mediaDeleteById")->name('media-delete-by-id');
    Route::any('edit-image/{id?}', "\App\Http\Controllers\Backend\Gallery\GalleryController@editImage")->name('edit-image');
    Route::any('restore-image', "\App\Http\Controllers\Backend\Gallery\GalleryController@restoreImage")->name('restore-image');


    Route::post('ckeditor-image-upload', [CkeditorController::class, 'index'])->name('ckeditor-image-upload');
    Route::resource('manage-category', "\App\Http\Controllers\Backend\Blogs\BlogCategoryController");
    Route::group(['prefix' => 'manage-ajax'], function () {
        Route::get('get-ajax-category', [AjaxController::class, 'getAjaxCategory'])->name('get-ajax-category');
        Route::post('get-ajax-category', [AjaxController::class, 'setAjaxCategory'])->name('get-ajax-category');
        Route::post('ajax-file-manage', [AjaxController::class, 'ajaxFileManage'])->name('ajax-file-manage');


        Route::get('get-ajax-album/{order_type?}', [AjaxController::class, 'getAjaxAlbum'])->name('get-ajax-album');
        Route::post('get-ajax-album', [AjaxController::class, 'setAjaxAlbum'])->name('get-ajax-album');
        Route::get('get-ajax-gallery', [AjaxController::class, 'getAjaxGallery'])->name('get-ajax-gallery');
        Route::get('get-ajax-only-image', [AjaxController::class, 'getOnlyImage'])->name('get-ajax-only-image');
        Route::post('get-ajax-search-image', [AjaxController::class, 'getSearchImage'])->name('get-ajax-search-image');
    });
});
