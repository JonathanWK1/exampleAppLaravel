<?php

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
    return view('welcome');
});

Auth::routes();

Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::patch('/post/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::get('/post', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::get('/post/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');

Route::patch('/profil/{user}', [App\Http\Controllers\ProfilController::class, 'update'])->name('profil.update');

Route::get('/profil/{user}/edit', [App\Http\Controllers\ProfilController::class, 'edit'])->name('profil.edit');
Route::get('/profil/{user}', [App\Http\Controllers\ProfilController::class, 'show'])->name('profil.show');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');