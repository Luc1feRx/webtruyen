<?php

use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Chapter\ChapterController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Upload\UploadController;
use FontLib\Table\Type\name;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//login
Route::get('admin/login', [LoginController::class, 'index'])->name('get-login');
Route::post('admin/login', [LoginController::class, 'store'])->name('login-admin');
Route::post('admin/log-out', [LoginController::class, 'logout'])->name('log-out');


Route::middleware(['auth'])->group(function () {

    Route::prefix('admin')->group(function () {
        //dashboard
        Route::get('/dashboard', [LoginController::class, 'show'])->name('dashboard');

        Route::resource('/category', CategoryController::class);

        Route::resource('/book', BookController::class);

        Route::resource('/chapters', ChapterController::class);

        Route::post('/storage/upload', [UploadController::class, 'store']);
    });

});


//home

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{slug}.html', [HomeController::class, 'doctruyen'])->name('doc-truyen');

Route::get('/danh-muc/{slug}.html', [HomeController::class, 'danhmuc'])->name('danh-muc');
Route::get('/chapter/{slug}.html', [HomeController::class, 'chapter'])->name('chapter');
Route::get('/search', [HomeController::class, 'Search'])->name('search');

//search by ajax
Route::post('/search-keywords', [HomeController::class, 'SearchAjax'])->name('search-ajax');
