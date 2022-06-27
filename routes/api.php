<?php

use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Chapter\ChapterController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Home\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Route::get('admin/login', [LoginController::class, 'index'])->name('get-login');
// Route::post('admin/login', [LoginController::class, 'store'])->name('login-admin');
// Route::post('admin/log-out', [LoginController::class, 'logout'])->name('log-out');

//search by ajax
Route::post('/search-keywords', [HomeController::class, 'SearchAjax'])->name('search-ajax');

//tabs_category
Route::post('/tabs-category', [HomeController::class, 'tabCate'])->name('tabCate');


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login-admin');
    Route::post('/log-out', [\App\Http\Controllers\AuthController::class, 'logout'])->name('log-out');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register');
});

// Route::apiResource('/category', CategoryController::class);

Route::group(['middleware' => 'api'], function (){
    Route::prefix('categories')->group(function () {
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });


    Route::prefix('books')->group(function () {
        Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    });


    Route::prefix('chapters')->group(function () {
        Route::delete('/delete/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
    });

    Route::prefix('sliders')->group(function () {
        Route::delete('/delete/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
    });

    Route::prefix('galleries')->group(function () {
        Route::delete('/delete/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });
});


Route::post('/featured-books', [BookController::class, 'featuredBooks'])->name('featured-books');
