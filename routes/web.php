<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\SliderController;

Route::get('/', [SiteController::class, 'index'])->name('index');
Route::get('/products/{product}', [SiteController::class, 'product'])->name('product');
Route::get('/cart', [SiteController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{product}', [SiteController::class, 'addToCart'])->name('add.to.cart')->middleware('auth');
Route::patch('update-cart', [SiteController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [SiteController::class, 'remove'])->name('remove.from.cart');


Route::get('/home', [SiteController::class, 'home'])->name('home')->middleware('auth');

Route::get('/search', [\App\Http\Controllers\SiteController::class, 'search'])->name('search');

// Route::group(
//     [
//         'middleware' => ['auth', 'admin'],
//         'name' => 'admin.',
//         'prefix' => 'admin'
//     ],
//     function () {
//         Route::get('/', [AdminController::class, 'index'])->name('index');
//         Route::resource('users', [UserController::class]);
//     }
// );
// 'auth', 'admin'
Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('users', UserController::class);
    Route::get('categories/slug', [CategoryController::class, 'generateSlug'])->name('categories.slug');
    Route::resource('categories', CategoryController::class);
    Route::get('products/slug', [ProductController::class, 'generateSlug'])->name('products.slug');
    Route::resource('products', ProductController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('attributes', AttributeController::class);
    Route::resource('coupons', CouponController::class);

    //orders
    Route::post('/orders/{order}/status', [OrderController::class, 'UpdateStatus'])->name('orders.status');
    Route::post('/orders/{order}/products', [OrderController::class, 'AddProduct'])->name('orders.products');
    Route::delete('/orders/{order}/products', [OrderController::class, 'removeProduct'])->name('orders.removeProducts');
    Route::get('/orders/{order}/{orderid}/quantity', [OrderController::class, 'editQuantity'])->name('orders.quantity.edit');
    Route::post('/orders/{order}/{orderid}/quantity', [OrderController::class, 'updateQuantity'])->name('orders.quantity.update');

    Route::resource('orders', OrderController::class)->except(['destroy']);
    Route::resource('sliders', SliderController::class);

    Route::resource('carts', CartController::class);
});
