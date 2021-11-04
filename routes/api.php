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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//> AdminPanel
Route::group(['namespace' => 'Admin', 'prefix' => 'admin',], function() {
    Route::resource('student', 'StudentController')
            ->names('admin.students')
            ->except('create');

    Route::resource('teacher', 'TeacherController')
            ->names('admin.teachers')
            ->except('create');

    Route::resource('schedule', 'ScheduleController')
            ->names('admin.schedules')
            ->except('create', 'show');

    Route::resource('group', 'GroupController')
            ->names('admin.groups')
            ->except('create', 'show');
});
//<

//> CustomerPanel
//Route::group(['namespace' => 'Customer'], function() {
//    Route::resource('student', 'StudentController')
//            ->names('customer.students');
//
//    Route::resource('teacher', 'TeacherController')
//            ->names('customer.teachers');
//
//    Route::resource('schedule', 'ScheduleController')
//            ->names('customer.schedules');
//
//    Route::resource('group', 'GroupController')
//            ->names('customer.groups');
//});
//<
