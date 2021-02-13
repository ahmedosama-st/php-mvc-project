<?php

use Acme\Http\Route;
use App\Controllers\HomeController;
use App\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'store']);
