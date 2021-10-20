<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', [MailController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

// Route::resource('blogs', [BlogController::class]);
Route::middleware(['auth'])->group(function () {
    Route::get('blogs/create', [App\Http\Controllers\BlogController::class, 'create']);
    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index']);
    Route::post('blogs', [App\Http\Controllers\BlogController::class, 'store']);
    Route::get('blogs/{post}/edit', [App\Http\Controllers\BlogController::class, 'edit']);
    Route::get('blogs/{post}', [App\Http\Controllers\BlogController::class, 'show']);
    Route::put('blogs/{post}', [App\Http\Controllers\BlogController::class, 'update']);
    Route::delete('blogs/{post}', [App\Http\Controllers\BlogController::class, 'destroy']);
    Route::get('blogs/approve/{post}', [App\Http\Controllers\BlogController::class, 'approve']);
});

