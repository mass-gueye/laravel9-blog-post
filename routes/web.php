<?php

use \App\Http\Controllers\PostsController;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\FallbackController;
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

Route::prefix('/blog')->group(function (){
    // GET
    Route::get('/create', [PostsController::class, 'create'])->name('blog.create');
    Route::get('/', [PostsController::class, 'index'])->name('blog.index');
    Route::get('/{id}', [PostsController::class, 'show'])->name('blog.show');
    // POST
    Route::post('/', [PostsController::class, 'store'])->name('blog.store');
    // PUT OR PATCH
    Route::get('/edit/{id}', [PostsController::class, 'edit'])->name('blog.edit');
    Route::patch('/{id}', [PostsController::class, 'update'])->name('blog.update');
    //DELETE
    Route::delete('/{id}', [PostsController::class, 'destroy'])->name('blog.destroy');
});
Route::fallback(FallbackController::class);
//Route::resource('blog', PostsController::class);
Route::get('/', HomeController::class);
