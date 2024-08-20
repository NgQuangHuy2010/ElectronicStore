<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;


Route::get("/", [HomeController::class, 'Index'])->name("User.Home");




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