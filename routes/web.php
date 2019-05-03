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

//Route::resource('companies', 'CompaniesController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Resources
Route::get('/resources', 'ResourcesController@index');
Route::get('/resources/{resource}', 'ResourcesController@show');

Route::post('/resources', 'ResourcesController@store')->middleware('role:manager');
Route::patch('/resources/{resource}', 'ResourcesController@update')->middleware('role:manager');
Route::delete('/resources/{resource}', 'ResourcesController@destroy')->middleware('role:manager');

// Companies
Route::post('/companies', 'CompaniesController@store')->name('companies/store')->middleware('role:manager');
Route::get('/companies', 'CompaniesController@index')->name('companies/index')->middleware('role:manager');

// Reservations
Route::post('/reservations', 'ReservationsController@store')->middleware('role:employee');
Route::patch('/reservations/{id}', 'ReservationsController@update')->middleware('role:employee');
Route::get('/reservations', 'ReservationsController@index')->middleware('role:manager');

Route::post('/reservations/{reservation}/state', 'ReservationsStateController@changeState')->middleware('role:manager');

Route::get('/settings', 'SettingsController@index')->name('settings');
Route::post('/settings', 'SettingsController@store')->name('settings.store');

Route::get('/google', 'GoogleController@index');
