<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Enrollment Controller
Route::resource('/enrollment','EnrollmentController');

//College Controller
Route::resource('/college','CollegeController');

//Student Controller
Route::resource('/student','StudentController');
