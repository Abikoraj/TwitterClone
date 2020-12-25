<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserAuthController;
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

Route::group(['middleware' => ['auth']], function () {

    Route::get("/", [HomeController::class, 'index'])->name('home');

    Route::prefix('post')->group(function () {
        Route::name('post.')->group(function () {
            Route::post('add', [PostController::class, 'add'])->name('add');
            Route::get('/delete/{post}', [PostController::class, 'delete'])->name('delete');
            Route::post('/edit/{post}', [PostController::class, 'edit'])->name('edit');
        });
    });

    Route::prefix('user/profile')->group(function () {
        Route::name('profile.')->group(function () {
            // Route::get('/', [ProfileController::class, 'add'])->name('add');
            Route::match(['GET', 'POST'], '/upload', [ProfileController::class, 'upload'])->name('upload');
            Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
            Route::post('/edit', [ProfileController::class, 'update'])->name('update');
        });
    });

    Route::get('/user/{id}', [HomeController::class, 'profile'])->name('profile');

    Route::get('logout', [UserAuthController::class, 'logout'])->name('logout');
});
// Route::view('url', 'auth.profile');

Route::match(['GET', 'POST'], 'register', [UserAuthController::class, 'register'])->name('register');
Route::match(['GET', 'POST'], 'login', [UserAuthController::class, 'login'])->name('login');
