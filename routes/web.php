<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Products;
use App\Livewire\RoomManager;
use App\Livewire\BookingManager;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/counter', Counter::class);
Route::get('/products', Products::class);
Route::get('/rooms', RoomManager::class);
Route::get('/bookings', BookingManager::class);
