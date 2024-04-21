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

Route::get('/', [\App\Http\Controllers\ImageController::class,'images.index'])->name('images.index');

Route::get('/create',[\App\Http\Controllers\ImageController::class,'create'])->name('images.create');

Route::post('/images',[\App\Http\Controllers\ImageController::class, 'save'])->name('images.save');

Route::get('/', [\App\Http\Controllers\ImageController::class, 'sort'])->name('images.sort');

Route::get('/download-images', [\App\Http\Controllers\ImageController::class, 'downloadImages'])->name('images.download');

Route::get('/Zip', [\App\Http\Controllers\ImageController::class,'Zip'])->name('images.zip');

Route::get('/json',[\App\Http\Controllers\ImageController::class, 'json'])->name('images.json');

Route::get('/findjson',[\App\Http\Controllers\ImageController::class,'findJson'])->name('images.findJson');
