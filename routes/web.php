<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilmController;

Route::get('/', fn() => redirect()->route('films.index'));

Route::get('/films', [FilmController::class, 'index'])->name('films.index');
Route::post('/films', [FilmController::class, 'store'])->name('films.store');

Route::get('/films/{id}/edit', [FilmController::class, 'edit'])->name('films.edit');
Route::put('/films/{id}', [FilmController::class, 'update'])->name('films.update');

Route::delete('/films/{id}', [FilmController::class, 'destroy'])->name('films.destroy');