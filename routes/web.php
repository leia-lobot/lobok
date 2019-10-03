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

//Route::resource('companies', 'CompaniesController');

Auth::routes();

//Route::get('login')->name('login')->uses('Auth\LoginController@showLoginForm')->middleware('guest');
//Route::post('login')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');

// Route::post('register')->name('login.attempt')->uses('Auth\LoginController@login')->middleware('guest');

// Route::post('logout')->name('logout')->uses('Auth\LoginController@logout');



Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/overview', 'HomeController@overview')->name('overview');
Route::get('/reservation/create', 'ReservationsController@create')->name('reservations/create');


Route::get('/google', 'GoogleController@index');

// Admin only
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/settings', 'SettingsController@index')->name('settings');
    Route::post('/settings', 'SettingsController@store')->name('settings/store');
});


// Manager + Admin
Route::group(['middleware' => ['role:admin|manager']], function () {


    Route::post('/companies', 'CompaniesController@store')->name('companies/store');                // Company::store
    Route::get('/companies/{slug}', 'CompaniesController@show')->name('companies/show');            // Company::show

    Route::post('/resources', 'ResourcesController@store')->name('resources/store');                // Resource::store
    Route::patch('/resources/{resource}', 'ResourcesController@update');                            // Resource::update
    Route::delete('/resources/{resource}', 'ResourcesController@destroy');                          // Resource::delete

    // Reservation Index
    Route::post('/reservations/{reservation}/state', 'ReservationsStateController@changeState');    // Reservation::toggleState

    Route::get('/resources', 'ResourcesController@index');                                          // Resource::index
    Route::get('/resources/{resource}', 'ResourcesController@show');                                // Resource::get

});

// Employer + Manager + Admin
Route::group(['middleware' => ['role:admin|manager|employer']], function () {
    Route::get('invite', 'InviteController@invite')->name('invite');
    Route::post('invite', 'InviteController@process')->name('process');
});

// Employee + Employer + Manager + Admin
Route::group(['middleware' => ['role:admin|manager|employer|employee']], function () {



    Route::patch('/reservations/{id}', 'ReservationsController@update');
    Route::delete('/reservations/{id}', 'ReservationsController@destroy');                           // Reservation::update
});

// Unemployed + Employee + Employer + Manager + Admin
Route::group(['middleware' => ['role:admin|manager|employer|employee|unemployed']], function () {
    //
});

// {token} is a required parameter that will be exposed to us in the controller method
Route::post('accept', 'InviteController@store');
Route::get('accept/{token}', 'InviteController@accept')->name('accept');

Route::get('seed', function () {
    factory('App\Reservation', 3)->create();
});

// TODO

Route::get('/companies', 'CompaniesController@index')->name('companies/index');                 // Company::index
Route::get('/companies/{id}', 'CompaniesController@view')->name('companies/view');                 // Company::index


Route::get('/reservations/create', 'ReservationsController@create');
Route::post('/reservations', 'ReservationsController@store')->name('reservations.store');                                   // Reservation::store

Route::get('/reservations', 'ReservationsController@index');                                    // Reservation::index
Route::get('/calendar', 'CalendarController@index');

Route::get('/dashboard/resource/overview', 'HomeController@overview')->name('dashboard.overview');
Route::get('/dashboard/resource/{id}', 'HomeController@resource')->name('dashboard.resource');
Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

Route::get('/dashboard/my-reservations', 'HomeController@myReservations')->name('dashboard.my-reservations');
