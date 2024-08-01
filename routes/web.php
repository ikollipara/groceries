<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserGroceriesController;
use App\Http\Controllers\UserPhoneNumberController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/groceries');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('groceries', UserGroceriesController::class)->except(['show']);
    Route::post('/phone-numbers', [UserPhoneNumberController::class, 'store'])->name('phone-numbers.store');
    Route::delete('/phone-numbers/{phoneNumber}', [UserPhoneNumberController::class, 'destroy'])->name('phone-numbers.destroy');
});

require __DIR__.'/auth.php';
