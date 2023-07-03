<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ManualController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class, "mainPage"])->middleware('isNotBan')->name("app.main");
Route::get('product/manuals/{product}', [AppController::class, "productManualPage"])->name("app.productManuals");
Route::get('manual/{manualSlug}', [AppController::class, "manualPage"])->name("app.manual-page");
Route::get('search/result', [AppController::class, "searchPage"])->name("app.search-page");

Route::post('create/{manual}', [ComplaintController::class, 'store'])->name("complaints.store");


Route::middleware(['auth'])->group(function(){

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'productsList'])->name("products.list");
        Route::get('create', [ProductController::class, 'createProduct'])->name("products.create");
        Route::post('create', [ProductController::class, 'storeProduct'])->name("products.store");
        Route::get('{productId}/edit', [ProductController::class, 'editProduct'])->name("products.edit");
        Route::put('{productId}/edit', [ProductController::class, 'updateProduct'])->name("products.update");
        Route::delete('{productId}', [ProductController::class, 'deleteProduct'])->name("products.delete");
    });
    
    Route::prefix('manuals')->group(function () {
        Route::get('/', [ManualController::class, 'index'])->name("manuals.index");
        Route::get('create', [ManualController::class, 'create'])->name("manuals.create");
        Route::post('create', [ManualController::class, 'store'])->name("manuals.store");
        Route::get('{manualId}/edit', [ManualController::class, 'edit'])->name("manuals.edit");
        Route::put('{manualId}/edit', [ManualController::class, 'update'])->name("manuals.update");
        Route::delete('{manualId}', [ManualController::class, 'delete'])->name("manuals.delete");
        Route::get('{manualSlug}', [ManualController::class, 'show'])->name("manuals.show");
        Route::get('{manualId}/remove-image', [ManualController::class, 'removeImage'])->name("manuals.remove-image");
    });
    
    Route::prefix('users')->middleware('role:super-admin')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name("users.index");
        Route::get('{user}/edit', [UserController::class, 'edit'])->name("users.edit");
        Route::put('{user}/edit', [UserController::class, 'update'])->name("users.update");
        Route::get('create', [AuthController::class, 'createNewUser'])->name("new-user.create");
        Route::post('create', [AuthController::class, 'storeUserByAdmin'])->name("new-user.store");
        Route::put('{user}/ban', [UserController::class, 'banUser'])->name("users.ban");
    });
    
    Route::prefix('roles')->middleware('role:super-admin')->group(function () {
        Route::get('/', [RoleController::class, 'index'])->name("roles.index");
        Route::get('create', [RoleController::class, 'create'])->name("roles.create");
        Route::post('create', [RoleController::class, 'store'])->name("roles.store");
        Route::get('{role}/edit', [RoleController::class, 'edit'])->name("roles.edit");
        Route::put('{role}/edit', [RoleController::class, 'update'])->name("roles.update");
    });

    Route::prefix('permissions')->middleware('role:super-admin')->group(function () {
        Route::get('/', [PermissionController::class, 'index'])->name("permissions.index");
        Route::get('create', [PermissionController::class, 'create'])->name("permissions.create");
        Route::post('create', [PermissionController::class, 'store'])->name("permissions.store");
    });
    Route::prefix('complaints')->middleware('role:super-admin')->group(function () {
        Route::get('/', [ComplaintController::class, 'index'])->name("complaints.index");
        
        Route::get("change-complaint-status/{complaint}", [ComplaintController::class, "changeStatus"])->name('complaint.change-status');
        Route::get('{complaint}', [ComplaintController::class, 'show'])->name("complaints.show");
    });
   
    
    Route::post('logout', [AuthController::class, 'logout'])->name("auth.logout");
    
});

Route::middleware(['guest'])->group(function ()
{
    Route::get('register', [AuthController::class, 'registerPage'])->name("auth.register");
    Route::post('register', [AuthController::class, 'storeUser'])->name("auth.store-user");
    Route::get('/reload-captcha', [CaptchaServiceController::class, 'reloadCaptcha']);
    Route::get('login', [AuthController::class, 'loginPage'])->name("auth.login-page");
    Route::post('login', [AuthController::class, 'login'])->name("auth.login");
    
}); 