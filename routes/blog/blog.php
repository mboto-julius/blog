<?php

use App\Http\Controllers\Backend\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::view('manage-categories','blog.categories.manage-categories')->name('manage.categories');

    Route::apiResources([
        'categories' => CategoryController::class,
    ]);

});