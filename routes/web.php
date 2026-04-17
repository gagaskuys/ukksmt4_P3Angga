<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/', function () {
    return view('auth.login');
});
