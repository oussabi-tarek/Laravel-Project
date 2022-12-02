<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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
    return view('home');
});

Route::get('',[HomeController::class, 'index']);
Route::get('/home/{name?}',[HomeController::class, 'index'])->name('home');
// Route::get('/post/{slug}',[HomeController::class,'show'])->name('post.show');
// Route::get('create/post',[HomeController::class,'create'])->name('post.create');
// Route::post('add/post',[HomeController::class,'store'])->name('post.store');
// Route::get('editer/post/{slug}',[HomeController::class,'editer'])->name('post.edit');
// Route::put('update/post/{slug}',[HomeController::class,'update'])->name('post.update');
// Route::delete('delete/post/{slug}',[HomeController::class,'delete'])->name('post.delete');


 Route::resource('categories',CategoryController::class);
 Route::resource('posts',PostController::class);
 Route::get('/post/restore/{slug}',[PostController::class,'restore'])->name('posts.restore');
 Route::delete('/post/delete/{slug}',[PostController::class,'delete'])->name('posts.delete');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect('/home');
    }) ;
});





















?>

