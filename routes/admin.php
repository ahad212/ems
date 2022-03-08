<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/


// employee routes
Route::get('/', function () {
    return view('admin.pages.index');
})->name('employee_list');
Route::get('/employee-create', function() {
    return view('admin.pages.create_employee');
})->name('create');


// employee education routes
Route::get('/{id}/educational-informations', function() {
    return view('admin.pages.educations.index');
})->name('education_view');
Route::get('/{id}/educational-inforamations/create', function() {
    return view('admin.pages.educations.create_education');
})->name('create_education');




// employee experience routes
Route::get('/{id}/experience-informations', function() {
    return view('admin.pages.experiences.index');
})->name('experience_view');
Route::get('/{id}/experience-informations/create', function() {
    return view('admin.pages.experiences.create_experience');
})->name('create_experience');