<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImpersonateController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/impersonate/start/{id}', [ImpersonateController::class, 'start'])->name('impersonate.start');
    Route::get('/impersonate/stop', [ImpersonateController::class, 'stop'])->name('impersonate.stop');
});
