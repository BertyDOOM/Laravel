<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
    Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
    Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
});
Route::get('/', function () {
    return view('welcome');
});
