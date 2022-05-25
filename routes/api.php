<?php

use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Chapter\ChapterController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Slider\SliderController;
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

Route::get('/dashboard', [LoginController::class, 'show'])->name('dashboard');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('get-login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login-admin');
    Route::post('/log-out', [\App\Http\Controllers\AuthController::class, 'logout'])->name('log-out');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

});

// Route::apiResource('/category', CategoryController::class);

Route::group(['middleware' => 'api'], function (){
    Route::prefix('categories')->group(function () {
        Route::get('/add', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');

        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');

        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');

        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

        Route::get('/get-all-categories', [CategoryController::class, 'GetAllCategory'])->name('category.getAll');
    });

    Route::prefix('books')->group(function () {
        Route::get('/add', [BookController::class, 'create'])->name('book.create');
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::post('/store', [BookController::class, 'store'])->name('book.store');

        Route::get('/edit/{book}', [BookController::class, 'edit'])->name('book.edit');

        Route::put('/update/{book}', [BookController::class, 'update'])->name('book.update');

        Route::delete('/delete/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    });


    Route::prefix('chapters')->group(function () {
        Route::get('/add', [ChapterController::class, 'create'])->name('chapters.create');
        Route::get('/', [ChapterController::class, 'index'])->name('chapters.index');
        Route::post('/store', [ChapterController::class, 'store'])->name('chapters.store');
        Route::get('/edit/{chapter}', [ChapterController::class, 'edit'])->name('chapters.edit');
        Route::put('/update/{chapter}', [ChapterController::class, 'update'])->name('chapters.update');
        Route::delete('/delete/{chapter}', [ChapterController::class, 'destroy'])->name('chapters.destroy');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/add', [SliderController::class, 'create'])->name('sliders.create');
        Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
        Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/edit/{slider}', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/update/{slider}', [SliderController::class, 'update'])->name('sliders.update');
        Route::delete('/delete/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
    });

    Route::prefix('galleries')->group(function () {
        Route::get('/add', [GalleryController::class, 'create'])->name('galleries.create');
        Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
        Route::post('/store', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/edit/{gallery}', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/update/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
        Route::delete('/delete/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    });
});


Route::post('/featured-books', [BookController::class, 'featuredBooks'])->name('featured-books');
