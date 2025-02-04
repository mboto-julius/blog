<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\TagController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::view('manage-categories','blog.categories.manage-categories')->name('manage.categories');
    Route::view('manage-tags', 'blog.tags.manage-tags')->name('manage.tags');
    Route::view('manage-posts', 'blog.posts.manage-posts')->name('manage.posts');

    Route::get('/tag-list', [TagController::class, 'getTagList']);

    Route::apiResources([
        'categories' => CategoryController::class,
        'tags' => TagController::class,
        'posts' => PostController::class,
    ]);

});