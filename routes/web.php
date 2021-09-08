<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

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

Route::any('/posts/search', [PostController::Class, 'search'])->name('posts.search');
Route::delete('/posts/{id}', [PostController::Class, 'destroy'])->name('posts.destroy');
Route::put('/posts/{id}', [PostController::Class, 'update'])->name('posts.update');
Route::post('/posts', [PostController::Class, 'store'])->name('posts.store');
Route::get('/posts/create', [PostController::Class, 'create'])->name('posts.create');
Route::get('/posts/edit/{id}', [PostController::Class, 'edit'])->name('posts.edit');
Route::get('/posts/{id}', [PostController::Class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::Class, 'index'])->name('posts.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
