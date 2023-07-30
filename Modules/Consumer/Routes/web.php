<?php

use Modules\Consumer\Http\Controllers\ConsumerController;
use Modules\Consumer\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['consumer.auth:sanctum,consumer'])->group(function () {
    Route::get('/', [ConsumerController::class, 'index']);
    Route::get('/dashboard', [ConsumerController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['consumer.auth'])->group(function () {

});

require __DIR__.'/auth.php';
