<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('admin.pages.index');
})->name('employee_list');
Route::get('/employee-create', function() {
    return view('admin.pages.create_employee');
})->name('create');