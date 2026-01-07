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

Route::middleware(['auth'])->group(function () {
Route::get('/publications', [PublicationController::class, 'index'])->name('publications.index');
Route::post('/publications', [PublicationController::class, 'store'])->name('publications.store');
Route::delete('/publications/{publication}', [PublicationController::class, 'destroy'])->name('publications.destroy');
});

require __DIR__.'/auth.php';
