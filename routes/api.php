<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function() {


    // employee
    Route::post('/create-employee', 'EmployeeController@create')->name('create_employee');
    Route::get('/employe-list', 'EmployeeController@employee_list')->name('employee_list');
    Route::put('/employee_edit/{employee_id}', 'EmployeeController@update')->name('update_employee');
    Route::get('/employee_delete/{employee_id}', 'EmployeeController@destroy')->name('destroy_employee');
    
    // employee education
    Route::post('/create-education', 'EmployeeEducationController@create')->name('create_education');
    Route::get('/education-list/{employee_id}', 'EmployeeEducationController@education_list')->name('education_list');
    Route::put('/education_edit/{education_id}', 'EmployeeEducationController@update')->name('update_education');
    Route::get('/education_delete/{education_id}', 'EmployeeEducationController@destroy')->name('destroy_education');

    // employee experience
    Route::post('/create-experience', 'EmployeeExperienceController@create')->name('create_experience');
    Route::get('/experience-list/{employee_id}', 'EmployeeExperienceController@experience_list')->name('experience_list');
    Route::put('/experience_edit/{experience_id}', 'EmployeeExperienceController@update')->name('update_experience');
    Route::get('/experience_delete/{experience_id}', 'EmployeeExperienceController@destroy')->name('destroy_experience');


    // single employee

    Route::get('/employee_profile/{id}', 'EmployeeController@employee')->name('single_employee');
});
