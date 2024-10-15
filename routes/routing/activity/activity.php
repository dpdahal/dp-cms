<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Activity\ActivityController;


Route::get('manage-activity', [ActivityController::class, 'index'])->name('manage-activity');
