<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;


//Customer level CRUD routes
Route::get('/feed', [ItemController::class, 'index'])->name('launch');
Route::get('/feed/{item}/post', [ItemController::class, 'show'])->name('item.show');

//Cart
Route::get('/customer/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/customer/cart/add', [CartController::class, 'addItem'])->name('cart.add');
Route::post('/customer/cart/remove', [CartController::class, 'removeItem'])->name('cart.remove');

//Owner level routes for posts
Route::get('/feed/post/create', [ItemController::class, 'create'])->name('item.create');
Route::post('feed/post', [ItemController::class, 'store'])->name('item.store');



//Owner level for task management
Route::get('/',[TaskController::class, 'index'])->name('task.index');