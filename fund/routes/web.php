<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController as I;

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
    Route::get('/delete/{idea}', [I::class, 'delete'])->name('delete');
    Route::delete('/{idea}', [I::class, 'destroy'])->name('destroy');
    Route::get('/edit/{idea}', [I::class, 'edit'])->name('edit');
    Route::put('/{idea}', [I::class, 'update'])->name('update');


});



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
