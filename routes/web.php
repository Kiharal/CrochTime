<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/',[TaskController::class, 'index']);
Route::get('/feed', [ItemController::class, 'index'])->name('launch');
