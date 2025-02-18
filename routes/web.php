<?php

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
    Route::get('/dashboard-data', [\App\Http\Controllers\Admin\DashboardController::class, 'dashboardData'])->name('dashboard.data');
    Route::get('/order-count', [\App\Http\Controllers\Admin\DashboardController::class, 'order'])->name('order.count');

    // category
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->middleware('permission:categories-read');
    Route::get('categories-data', [\App\Http\Controllers\Admin\CategoryController::class, 'data'])->name('categories.data')->middleware('permission:categories-read');

    // product
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->middleware('permission:products-read');
    Route::get('products-data', [\App\Http\Controllers\Admin\ProductController::class, 'data'])->name('products.data')->middleware('permission:products-read');
    Route::post('products-upload', [\App\Http\Controllers\Admin\ProductController::class, 'upload'])->name('products.upload')->middleware('permission:products-read');

    // blog
    Route::resource('blogs', \App\Http\Controllers\Admin\BlogController::class)->middleware('permission:blog-read');
    Route::get('blogs-data', [\App\Http\Controllers\Admin\BlogController::class, 'data'])->name('blogs.data')->middleware('permission:blog-read');

    // blog category
    Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class)->middleware('permission:blog-categories-read');
    Route::get('blog-categories-data', [\App\Http\Controllers\Admin\BlogCategoryController::class, 'data'])->name('blog-categories.data')->middleware('permission:blog-categories-read');

    Route::resource('about-us', \App\Http\Controllers\Admin\AboutController::class)->middleware('role:developer|admin');

    // banner
    Route::resource('galleries', \App\Http\Controllers\Admin\GalleryController::class)->middleware('permission:gallery-read');
    Route::get('galleries-data', [\App\Http\Controllers\Admin\GalleryController::class, 'data'])->name('galleries.data')->middleware('permission:gallery-read');

    // image
    Route::delete('image/{id}', [\App\Http\Controllers\Admin\GalleryController::class, 'delete'])->name('images.destroy')->middleware('permission:order-read');

    // contact
    Route::get('contacts', [\App\Http\Controllers\Admin\CompanyController::class, 'contact'])->name('contact.index')->middleware('role:admin|developer');
    Route::post('contacts', [\App\Http\Controllers\Admin\CompanyController::class, 'storeContact'])->name('contact.store')->middleware('role:admin|developer');

    // message
    Route::get('messages', [\App\Http\Controllers\Admin\MessageController::class, 'index'])->name('messages.index')->middleware('permission:message-read');
    Route::get('messages-data', [\App\Http\Controllers\Admin\MessageController::class, 'data'])->name('messages.data')->middleware('permission:message-read');

    // order
    Route::get('orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index')->middleware('permission:order-read');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show')->middleware('permission:order-read');
    Route::put('orders/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update')->middleware('permission:order-update');
    Route::put('orders-status/{order}', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus')->middleware('permission:order-update');
    Route::get('orders-data', [\App\Http\Controllers\Admin\OrderController::class, 'data'])->name('orders.data')->middleware('permission:order-read');

    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('permission:users-read|users-create|users-update|users-delete');
    Route::get('users-data', [\App\Http\Controllers\Admin\UserController::class, 'data'])->name('users.data')->middleware('permission:users-read');

    Route::resource('brands', \App\Http\Controllers\Admin\BrandController::class)->middleware('role:developer|admin');
    Route::get('brands-data', [\App\Http\Controllers\Admin\BrandController::class, 'data'])->name('brands.data')->middleware('role:developer|admin');
});

require __DIR__.'/auth.php';

// set locale
Route::get('/lang/{locale}', function ($locale) {
    \Illuminate\Support\Facades\Session::put('locale', $locale);

    return redirect()->back();
})->middleware('locale')->name('lang');

Route::get('generate-surat-jalan/{id}', [\App\Http\Controllers\PdfController::class, 'generateSuratJalan'])->name('generateSuratJalan');
