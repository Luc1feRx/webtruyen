<?php

use App\Http\Controllers\Admin\Book\BookController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Chapter\ChapterController;
use App\Http\Controllers\Admin\Gallery\GalleryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Slider\SliderController;
use App\Http\Controllers\Admin\Usercontroller;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Upload\UploadController;
use App\Http\Controllers\UserController as ControllersUserController;
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
// Route::get('admin/login', [LoginController::class, 'index'])->name('get-login');
// Route::post('admin/login', [LoginController::class, 'store'])->name('login-admin');
// Route::post('admin/log-out', [LoginController::class, 'logout'])->name('log-out');




// Route::middleware(['auth'])->group(function () {

//     Route::prefix('admin')->group(function () {
//         //dashboard
//         Route::get('/dashboard', [LoginController::class, 'show'])->name('dashboard');

//         Route::resource('/category', CategoryController::class);

//         Route::resource('/book', BookController::class);

//         Route::resource('/chapters', ChapterController::class);

//         Route::post('/storage/upload', [UploadController::class, 'store']);

//         Route::post('/featured-books', [BookController::class, 'featuredBooks'])->name('featured-books');
//     });

// });


//home

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{slug}.html', [HomeController::class, 'doctruyen'])->name('doc-truyen');

Route::get('/danh-muc/{slug}.html', [HomeController::class, 'danhmuc'])->name('danh-muc');
Route::get('/chapter/{slug}.html', [HomeController::class, 'chapter'])->name('chapter');
Route::get('/search', [HomeController::class, 'Search'])->name('search');


//filter
Route::get('/filtered/{char}', [HomeController::class, 'filteredChar'])->name('filteredChar');



//Admin
Route::get('/dashboard', [LoginController::class, 'show'])->name('dashboard');
Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('get-login');
});

Route::group(['middleware' => 'api'], function (){
    Route::prefix('categories')->group(function () {
        Route::get('/add', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::get('/get-all-categories', [CategoryController::class, 'GetAllCategory'])->name('category.getAll');
    });

    Route::prefix('books')->group(function () {
        Route::get('/add', [BookController::class, 'create'])->name('book.create');
        Route::get('/', [BookController::class, 'index'])->name('book.index');
        Route::post('/store', [BookController::class, 'store'])->name('book.store');

        Route::get('/edit/{book}', [BookController::class, 'edit'])->name('book.edit');

        Route::put('/update/{book}', [BookController::class, 'update'])->name('book.update');

        Route::post('/store-photo', [BookController::class, 'storeImage'])->name('image.store');
    });


    Route::prefix('chapters')->group(function () {
        Route::get('/add', [ChapterController::class, 'create'])->name('chapters.create');
        Route::get('/', [ChapterController::class, 'index'])->name('chapters.index');
        Route::post('/store', [ChapterController::class, 'store'])->name('chapters.store');
        Route::get('/edit/{chapter}', [ChapterController::class, 'edit'])->name('chapters.edit');
        Route::put('/update/{chapter}', [ChapterController::class, 'update'])->name('chapters.update');
    });

    Route::prefix('sliders')->group(function () {
        Route::get('/add', [SliderController::class, 'create'])->name('sliders.create');
        Route::get('/', [SliderController::class, 'index'])->name('sliders.index');
        Route::post('/store', [SliderController::class, 'store'])->name('sliders.store');
        Route::get('/edit/{slider}', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/update/{slider}', [SliderController::class, 'update'])->name('sliders.update');
    });

    Route::prefix('galleries')->group(function () {
        Route::get('/add', [GalleryController::class, 'create'])->name('galleries.create');
        Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
        Route::post('/store', [GalleryController::class, 'store'])->name('galleries.store');
        Route::get('/edit/{gallery}', [GalleryController::class, 'edit'])->name('galleries.edit');
        Route::put('/update/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    });

    Route::resource('user', UserController::class);

    Route::get('/ApprovePermission/{id}', [UserController::class, 'ApprovePermission'])->name('ApprovePermission');
    Route::get('/ApproveRole/{id}', [UserController::class, 'ApproveRole'])->name('ApproveRole');
    Route::post('/insertRole/{id}', [UserController::class, 'insertRole'])->name('insertRole');
    Route::post('/insertPermission/{id}', [UserController::class, 'insertPermission'])->name('insertPermission');
});

