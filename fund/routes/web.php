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

    Route::get('/', [I::class, 'index'])->middleware(['roles:G|U|A'])->name('index');

    Route::get('/create', [I::class, 'create'])->middleware(['roles:U|A'])->name('create');
    Route::post('/', [I::class, 'store'])->middleware(['roles:U|A'])->name('store');

    Route::get('/edit/{idea}', [I::class, 'edit'])->middleware(['roles:U|A'])->name('edit');
    Route::put('/{idea}', [I::class, 'update'])->middleware(['roles:U|A'])->name('update');

    Route::get('/delete/{idea}', [I::class, 'delete'])->middleware(['roles:A'])->name('delete');
    Route::delete('/{idea}', [I::class, 'destroy'])->middleware(['roles:A'])->name('destroy');

    Route::post('/tags/{idea}', [I::class, 'addTag'])->middleware(['roles:U|A'])->name('add-tag');
    Route::delete('/tags/{idea}/{tag}', [I::class, 'removeTag'])->middleware(['roles:U|A'])->name('remove-tag');
    Route::post('/tags/create/{idea}', [I::class, 'createTag'])->middleware(['roles:U|A'])->name('create-tag');

    Route::get('/donate/{idea}', [I::class, 'donate'])->middleware(['roles:G|U|A'])->name('donate');
    Route::put('/donate/{idea}', [I::class, 'addmoney'])->middleware(['roles:G|U|A'])->name('addmoney');

    Route::post('/love/{idea}', [I::class, 'addLove'])->middleware(['roles:U|A'])->name('add-love');

    Route::get('/approve/{idea}', [I::class, 'approve'])->middleware(['roles:A'])->name('approve');

});

Route::prefix('tags')->name('tags-')->group(function () {

    Route::get('/', [T::class, 'index'])->middleware(['roles:U|A'])->name('index');
    Route::get('/create', [T::class, 'create'])->middleware(['roles:U|A'])->name('create');

    Route::get('/delete/{tag}', [T::class, 'delete'])->middleware(['roles:A'])->name('delete');
    Route::delete('/{tag}', [T::class, 'destroy'])->middleware(['roles:A'])->name('destroy');


    Route::post('/', [T::class, 'store'])->middleware(['roles:U|A'])->name('store');

    Route::get('/edit/{tag}', [T::class, 'edit'])->middleware(['roles:U|A'])->name('edit');
    Route::put('/{tag}', [T::class, 'update'])->middleware(['roles:U|A'])->name('update');

});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');