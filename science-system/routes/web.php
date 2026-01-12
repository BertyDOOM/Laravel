<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
 


// силно импровизирано
Route::middleware(['auth'])->group(function () {
    Route::get('/public/publications', [PublicationController::class, 'index'])->name('publications.index');
    Route::post('/public/publications', [PublicationController::class, 'store'])->name('publications.store');
    Route::delete('/public/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');

    Route::get('/public/publications/{publication}/edit', [PublicationController::class, 'edit'])
    ->name('publications.edit');

    Route::put('/public/publications/{publication}', [PublicationController::class, 'update'])
        ->name('publications.update');

});

require __DIR__.'/auth.php';
