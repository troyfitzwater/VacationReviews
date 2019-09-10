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

Route::get('/', 'HomeController@index');

Route::get('/vacations', 'VacationController@index');
Route::get('/vacations/{vacation}', 'VacationController@show')->name('show_vacation');
Route::get('/vacations/{vacation}/createReview', 'ReviewController@create')->middleware('auth');
Route::post('/vacations/{vacation}', 'ReviewController@store');
Route::delete('vacations/reviews/{review}', 'ReviewController@destroy');
Route::get('/vacations/reviews/{review}/edit', 'ReviewController@edit');
Route::patch('/vacations/reviews/{review}', 'ReviewController@update');

// Scaffold authenticaiton related routes
Auth::routes();

// Redirect to landing page for logging out while not logged in
Route::get('logout', 'Auth\LoginController@logout', function () {
    return abort(404);
});