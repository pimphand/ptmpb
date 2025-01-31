<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::get('/about-us', [\App\Http\Controllers\Frontend\HomeController::class, 'about_us'])->name('about_us');
Route::post('/upload', [\App\Http\Controllers\Frontend\HomeController::class, 'upload'])->name('upload');
Route::get('/blog/{id}', [\App\Http\Controllers\Frontend\HomeController::class, 'blog'])->name('blog');
Route::get('/blogs', [\App\Http\Controllers\Frontend\HomeController::class, 'blogs'])->name('blogs');
Route::get('/products', [\App\Http\Controllers\Frontend\HomeController::class, 'products'])->name('products');
Route::get('/products/{brand}/{slug}', [\App\Http\Controllers\Frontend\HomeController::class, 'product'])->name('product');

Route::get('/products-data', [\App\Http\Controllers\Frontend\HomeController::class, 'listProduct'])->name('listProduct');
Route::get('/checkout', [\App\Http\Controllers\Frontend\HomeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [\App\Http\Controllers\Frontend\HomeController::class, 'saveOrder']);
Route::get('/contact', [\App\Http\Controllers\Frontend\HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\Frontend\HomeController::class, 'saveContact']);

Route::get('/home-teams', [\App\Http\Controllers\Frontend\HomeController::class, 'teams'])->name('home-teams');
Route::get('/gallery', [\App\Http\Controllers\Frontend\HomeController::class, 'gallery'])->name('gallery');


Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    //category
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    Route::get('categories-data', [\App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('categories.data');

    //product
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::get('products-data', [\App\Http\Controllers\Admin\ProductController::class, 'data'])->name('products.data');
    Route::post('products-upload', [\App\Http\Controllers\Admin\ProductController::class, 'upload'])->name('products.upload');

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

    //contact
    Route::get('contacts', [\App\Http\Controllers\Admin\CompanyController::class, 'contact'])->name('contact.index');
    Route::post('contacts', [\App\Http\Controllers\Admin\CompanyController::class, 'storeContact'])->name('contact.store');

    //message
    Route::get('messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index');
    Route::get('messages-data', [\App\Http\Controllers\Admin\MessageController::class, 'data'])->name('messages.data');

    //order
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::put('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
    Route::put('orders-status/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('orders-data', [\App\Http\Controllers\Admin\OrderController::class, 'data'])->name('orders.data');
});

require __DIR__ . '/auth.php';

//set locale
Route::get('/lang/{locale}', function ($locale) {
    \Illuminate\Support\Facades\Session::put('locale', $locale);
    return redirect()->back();
})->middleware('locale')->name('lang');
