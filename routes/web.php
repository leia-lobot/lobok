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

Route::resource('companies', 'CompaniesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/reservations', 'ReservationsController@store');
Route::get('/reservations', 'ReservationsController@index');

Route::post('/resources', 'ResourcesController@store')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);
Route::patch('/resources/{resource}', 'ResourcesController@update')->middleware('check_user_role:'.UserRole::ROLE_MANAGER);
Route::get('/resources', 'ResourcesController@index');
