<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\VerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;

//route user
Route::get("/", [HomeController::class, 'Index'])->name("User.Home");
Route::get("/product/{id}", [UserProductController::class, 'Index'])->name("User.Product");
Route::get("/details/{name}/{id}", [UserProductController::class, 'Details'])->name("User.ProductDetails");
Route::get('/cart', [CartController::class, 'ViewCart'])->name('User.ViewCart');
Route::post('/cart/add', [CartController::class, 'AddToCart'])->name('User.AddToCart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');
Route::get('/cart/item-count', [CartController::class, 'GetCartItemCount'])->name('User.GetCartItemCount');
Route::match(['get', 'post'], '/checkout', [CheckoutController::class, 'Index'])->name('User.CheckoutIndex');
Route::post('/checkout/payment', [CheckoutController::class, 'CheckoutPost'])->name('User.CheckoutPost');
//login
Route::match(['get', 'post'], '/login', [LoginController::class, 'Login'])->name('User.Login');
Route::match(['get', 'post'], '/register', [LoginController::class, 'Register'])->name('User.Register');
// Route xác thực email
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'Verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

// Route gửi lại email xác thực
Route::post('/email/resend', [VerificationController::class, 'Resend'])
    ->middleware(['auth'])
    ->name('verification.resend');

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
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
