<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clock', function () {
    return view('clock');
});

Route::get('/employees', function () {
    return view('employees');
});

Route::get('/salaries', function () {
    return view('salaries');
});

Route::get('/price', function () {
    return view('pricing');
});