<?php

use App\Http\Controllers\KatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Halo, kelompok 3';
});

Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog.index');
Route::get('/katalog/create', [KatalogController::class, 'create'])->name('katalog.create');
Route::post('/katalog', [KatalogController::class, 'store'])->name('katalog.store');
Route::get('/katalog/{product}/edit', [KatalogController::class, 'edit'])
    ->whereNumber('product')
    ->name('katalog.edit');
Route::put('/katalog/{product}', [KatalogController::class, 'update'])
    ->whereNumber('product')
    ->name('katalog.update');
Route::delete('/katalog/{product}', [KatalogController::class, 'destroy'])
    ->whereNumber('product')
    ->name('katalog.destroy');
Route::get('/katalog/{product}', [KatalogController::class, 'show'])
    ->whereNumber('product')
    ->name('katalog.show');
