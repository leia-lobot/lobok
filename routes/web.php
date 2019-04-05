<?php

use App\Role\UserRole;

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

//Route::resource('companies', 'CompaniesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Resources
Route::get('/resources', 'ResourcesController@index');
Route::get('/resources/{resource}', 'ResourcesController@show');

Route::post('/resources', 'ResourcesController@store')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);
Route::patch('/resources/{resource}', 'ResourcesController@update')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);
Route::delete('/resources/{resource}', 'ResourcesController@destroy')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);

// Companies
Route::post('/companies', 'CompaniesController@store')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);

// Reservations
Route::post('/reservations', 'ReservationsController@store')->middleware('check_user_role:'.UserRole::ROLE_EMPLOYEE);
Route::patch('/reservations/{id}', 'ReservationsController@update')->middleware('check_user_role:'.UserRole::ROLE_EMPLOYEE);
Route::get('/reservations', 'ReservationsController@index')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);

Route::post('/reservations/{reservation}/state', 'ReservationsStateController@changeState')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);
