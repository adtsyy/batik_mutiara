<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard_kasir', function () {
    return view('dashboard_kasir');
});
Route::get('/dashboard_admin', function () {
    return view('dashboard_admin');
});
