<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/about-us', [\App\Http\Controllers\Frontend\HomeController::class, 'about_us'])->name('about_us');
Route::get('/blog/{id}', [\App\Http\Controllers\Frontend\HomeController::class, 'blog'])->name('blog');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    //category
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::get('categories-data', [\App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('categories.data');

    //product
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('products-data', [\App\Http\Controllers\Admin\ProductController::class, 'data'])->name('products.data');

    //blog
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class);
    Route::get('blogs-data', [\App\Http\Controllers\Admin\BlogController::class, 'data'])->name('blogs.data');

    //blog category
    Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);
    Route::get('blog-categories-data', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'data'])->name('blog-categories.data');

    Route::resource('about-us', \App\Http\Controllers\Admin\AboutController::class);

    //banner
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class);
    Route::get('galleries-data', [\App\Http\Controllers\Admin\GalleryController::class, 'data'])->name('galleries.data');

    //image
    Route::delete('image/{id}', [\App\Http\Controllers\Admin\GalleryController::class, 'delete'])->name('images.destroy');

});

require __DIR__.'/auth.php';

//set locale
Route::get('/lang/{locale}', function ($locale) {
    \Illuminate\Support\Facades\Session::put('locale', $locale);
    return redirect()->back();
})->middleware('locale')->name('lang');
