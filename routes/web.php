<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UserProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;


//route user
Route::get("/", [HomeController::class, 'Index'])->name("User.Home");
Route::get("/product/{id}", [UserProductController::class, 'Index'])->name("User.Product");
Route::get("/details/{name}/{id}", [UserProductController::class, 'Details'])->name("User.ProductDetails");
Route::get('/cart', [CartController::class, 'ViewCart'])->name('User.ViewCart');
Route::post('/cart/add', [CartController::class, 'AddToCart'])->name('User.AddToCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/item-count', [CartController::class, 'GetCartItemCount'])->name('User.GetCartItemCount');
//end route user

// route Admin
Route::prefix('system')->group(function () {
    Route::get("/admin/dashboard", [DashboardController::class, 'Index'])->name("Admin.Dashboard");

    //category
    Route::get("/admin/category/index", [CategoryController::class, 'Index'])->name("Admin.CategoryIndex");
    Route::match(['get', 'post'], "/admin/category/create", [CategoryController::class, 'Create'])->name("Admin.CategoryCreate");
    Route::match(['get', 'post'], "/admin/category/update/{id}", [CategoryController::class, 'Update'])->name("Admin.CategoryUpdate");
    Route::get("/admin/category/delete/{id}", [CategoryController::class, 'Delete'])->name("Admin.CategoryDelete");

    //product
    Route::get("/admin/product/index", [ProductController::class, 'Index'])->name("Admin.ProductIndex");
    Route::match(['get', 'post'], "/admin/product/create", [ProductController::class, 'Create'])->name("Admin.ProductCreate");
    Route::match(['get', 'post'], "/admin/product/update/{id}", [ProductController::class, 'Update'])->name("Admin.ProductUpdate");
    Route::get("/admin/product/delete/{id}", [ProductController::class, 'Delete'])->name("Admin.ProductDelete");
});