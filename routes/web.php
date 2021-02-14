<?php

use SecTheater\Http\Route;
use App\Controllers\Auth\RegisterController;
use App\Controllers\HomeController;
use App\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);

Route::get('/signup', [RegisterController::class, 'index']);
Route::post('/signup', [RegisterController::class, 'store']);
