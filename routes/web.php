<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/', [HomeController::class, 'index'])->name('home');
//photo
Route::get('/photo', [App\Http\Controllers\PhotoController::class, 'index'])->name('photo.index');
Route::get('/photo/create', [App\Http\Controllers\PhotoController::class, 'create'])->name('photo.create');
Route::post('/photo', [App\Http\Controllers\PhotoController::class, 'store'])->name('photo.store');
Route::get('/photo/{id}', [App\Http\Controllers\PhotoController::class, 'show'])->name('photo.show');
Route::get('/photo/{id}/edit', [App\Http\Controllers\PhotoController::class, 'edit'])->name('photo.edit');
Route::put('/photo/{id}', [App\Http\Controllers\PhotoController::class, 'update'])->name('photo.update');
Route::delete('/photo/{id}', [App\Http\Controllers\PhotoController::class, 'destroy'])->name('photo.destroy');

//video

Route::get('/video', [App\Http\Controllers\VideoController::class, 'index'])->name('video.index');
Route::get('/video/create', [App\Http\Controllers\VideoController::class, 'create'])->name('video.create');
Route::post('/video', [App\Http\Controllers\VideoController::class, 'store'])->name('video.store');
Route::get('/video/{id}', [App\Http\Controllers\VideoController::class, 'show'])->name('video.show');
Route::get('/video/{id}/edit', [App\Http\Controllers\VideoController::class, 'edit'])->name('video.edit');
Route::put('/video/{id}', [App\Http\Controllers\VideoController::class, 'update'])->name('video.update');
Route::delete('/video/{id}', [App\Http\Controllers\VideoController::class, 'destroy'])->name('video.destroy');

//diary
Route::get('/diary', [App\Http\Controllers\DiaryController::class, 'index'])->name('diary.index');
Route::get('/diary/create', [App\Http\Controllers\DiaryController::class, 'create'])->name('diary.create');
Route::post('/diary', [App\Http\Controllers\DiaryController::class, 'store'])->name('diary.store');
Route::get('/diary/{id}', [App\Http\Controllers\DiaryController::class, 'show'])->name('diary.show');
Route::get('/diary/{id}/edit', [App\Http\Controllers\DiaryController::class, 'edit'])->name('diary.edit');
Route::put('/diary/{id}', [App\Http\Controllers\DiaryController::class, 'update'])->name('diary.update');
Route::delete('/diary/{id}', [App\Http\Controllers\DiaryController::class, 'destroy'])->name('diary.destroy');

//audio
Route::get('/audio', [App\Http\Controllers\AudioController::class, 'index'])->name('audio.index');
Route::get('/audio/create', [App\Http\Controllers\AudioController::class, 'create'])->name('audio.create');
Route::post('/audio', [App\Http\Controllers\AudioController::class, 'store'])->name('audio.store');
Route::get('/audio/{id}/edit', [App\Http\Controllers\AudioController::class, 'edit'])->name('audio.edit');
Route::put('/audio/{id}', [App\Http\Controllers\AudioController::class, 'update'])->name('audio.update');
Route::delete('/audio/{id}', [App\Http\Controllers\AudioController::class, 'destroy'])->name('audio.destroy');