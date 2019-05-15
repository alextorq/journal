<?php

use Illuminate\Http\Request;

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

Route::resource('/lessons', 'LessonsController');

Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');
Route::get('/schedule/by/{user}', 'ScheduleController@getSchedule')->name('schedule.user.schedule');
Route::post('/schedule', 'ScheduleController@store')->name('schedule.store');

Route::get('/students', 'StudentsController@index')->name('students.index');

Route::get('/students/{user}', 'StudentsController@show')->name('students.show');

Route::get('/teachers', 'UsersController@getTeachers')->name('teachers.get');
Route::get('/schedule-by-day', 'ScheduleController@getScheduleByUserAndDayOfTheWeek')->name('getSchedule.byDay');
