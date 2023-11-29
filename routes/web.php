<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmokeController;



Route::get('/', [SmokeController::class, 'index'])->name('smoke.index');
Route::post('/', [SmokeController::class, 'update'])->name('smoke.update');
