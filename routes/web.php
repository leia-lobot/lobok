<?php

use App\Booking;

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

Route::post('/bookings', function () {
    Booking::create(request(['resource_id', 'company_id', 'user_id', 'start_time', 'end_time', 'extras']));

    return redirect('/bookings');
});
