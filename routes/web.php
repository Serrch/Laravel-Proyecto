<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonsterController;


Route::get('/', function () {
    return view('auth.login');
});

Route::resource('Monster', MonsterController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [MonsterController::class, 'index'])->name('home');


Route::group(['middleware'=> 'auth'], function () {
    Route::get('/', [MonsterController::class, 'index'])->name('home');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/Monster/{id}/details', [MonsterController::class, 'show'])->name('monster.details');

Route::get('/Monster/{id?}', [MonsterController::class, 'index'])->name('home')->middleware('auth');