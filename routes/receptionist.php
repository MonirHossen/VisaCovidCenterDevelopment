<?php

use Illuminate\Support\Facades\Route;

// Receptionist route
Route::group(['prefix' => 'receptionist/', 'namespace' => 'Receptionist', 'as' => 'receptionist.', 'middleware' => ['auth', 'receptionist']], function () {

    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('new-registration', 'NewRegistrationController@index')->name('newRegistration.index');
    Route::get('new-registration-filter/{searchKey}', 'NewRegistrationController@filter')->name('newRegistration.filter');
    Route::get('printing', 'PrintController@index')->name('printing.index');
    Route::get('user', 'UserController@index')->name('user.index');

});
