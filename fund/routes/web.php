<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController as I;
use App\Http\Controllers\TagController as T;

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

Route::prefix('ideas')->name('ideas-')->group(function () {

    Route::get('/', [I::class, 'index'])->name('index');

    Route::get('/create', [I::class, 'create'])->name('create');
    Route::post('/', [I::class, 'store'])->name('store');

    Route::get('/edit/{idea}', [I::class, 'edit'])->name('edit');
    Route::put('/{idea}', [I::class, 'update'])->name('update');

    Route::get('/delete/{idea}', [I::class, 'delete'])->name('delete');
    Route::delete('/{idea}', [I::class, 'destroy'])->name('destroy');

    Route::post('/tags/{idea}', [I::class, 'addTag'])->name('add-tag');
    Route::delete('/tags/{idea}/{tag}', [I::class, 'removeTag'])->name('remove-tag');
    Route::post('/tags/create/{idea}', [I::class, 'createTag'])->name('create-tag');

    Route::put('/donate/{idea}', [I::class, 'donate'])->name('donate');

});

Route::prefix('tags')->name('tags-')->group(function () {

    Route::get('/', [T::class, 'index'])->name('index');
    Route::get('/create', [T::class, 'create'])->name('create');

    Route::get('/delete/{tag}', [T::class, 'delete'])->name('delete');
    Route::delete('/{tag}', [T::class, 'destroy'])->name('destroy');


    Route::post('/', [T::class, 'store'])->name('store');

    Route::get('/edit/{tag}', [T::class, 'edit'])->name('edit');
    Route::put('/{tag}', [T::class, 'update'])->name('update');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');