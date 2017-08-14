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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth_user',function (){ return Auth::user(); });

Auth::routes();

Route::get('/courses/{id}/join','CourseController@joinCourse');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('courses','CourseController');
