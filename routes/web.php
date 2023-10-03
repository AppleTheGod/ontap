<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Category;
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

Route::get('/', function () {
    return view('Client.home');
});
Route::get('/login', [AuthController::class, 'loginPage'])->name('login')->middleware('CheckLogin');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('loginProcess');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
Route::post('/register-process', [AuthController::class, 'registerProcess'])->name('registerProcess');
Route::get('/log-out', [AuthController::class, 'logOut'])->name('logOut');

Route::prefix('admin')->middleware(['auth', 'CheckAdmin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashbroad');
    // CATEGORY
    Route::prefix('category')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('admin.category.index');
        Route::post('/', 'index')->name('admin.category.search');
        Route::get('/create', 'create')->name('admin.category.create');
        Route::post('/store', 'store')->name('admin.category.store');
        Route::get('/edit/{id}', 'edit')->name('admin.category.edit');
        Route::post('/update/{id}', 'update')->name('admin.category.update');
        Route::get('/archive', 'archive')->name('admin.category.archive');
        Route::get('/destroy/{id}', 'destroy')->name('admin.category.destroy');
        Route::get('/remove/{id}', 'remove')->name('admin.category.remove')->withTrashed();
        Route::get('/restore/{id}', 'restore')->name('admin.category.restore')->withTrashed();
    });
    // PRODUCTS
    Route::prefix('product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product.index');
        Route::post('/', 'index')->name('admin.product.search');
        Route::get('/create', 'create')->name('admin.product.create');
        Route::post('/store', 'store')->name('admin.product.store');
        Route::get('/edit/{id}', 'edit')->name('admin.product.edit');
        Route::post('/update/{id}', 'update')->name('admin.product.update');
        Route::get('/destroy/{id}', 'destroy')->name('admin.product.destroy');
        Route::get('/archive', 'archive')->name('admin.product.archive');
        Route::get('/restore/{id}', 'restore')->name('admin.product.restore')->withTrashed();
        Route::get('/remove/{id}', 'remove')->name('admin.product.remove')->withTrashed();

    });
});
