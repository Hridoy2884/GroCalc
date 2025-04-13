<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalController;
use App\Http\Controllers\ProfileController;


// Redirect root URL to calculator route
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/calculator', function () {
        return view('welcome');
    })->name('calculator');

    Route::post('/calculate', [CalController::class, 'calculate'])->name('calculate');

    Route::get('/viewdata', [CalController::class, 'viewData'])->name('viewdata');

    Route::get('/dashboard', [CalController::class, 'viewGrandData'])->name('dashboard');

    Route::delete('/clear-all', [CalController::class, 'clearAll'])->name('clearAll');

    Route::get('/download-pdf', [CalController::class, 'downloadPDF'])->name('downloadPDF');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

 

});
require __DIR__.'/auth.php';
