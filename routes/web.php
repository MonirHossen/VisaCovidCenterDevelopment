<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

include('superAdmin.php');
include('bdGovt.php');
include('administrator.php');
include('receptionist.php');
include('volunteer.php');
include('pathologist.php');
include('immigrationOfficer.php');

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'LandingPageController@index')->name('frontend.index');
Route::post('/subscribe/store', 'LandingPageController@subscribeStore')->name('frontend.subscribeStore');


// Auth::routes();
Auth::routes(['register' => false]);

//log in route
Route::get('immigration-officer-login', 'Auth\CustomLoginController@immigrationOfficerLogin')->name('auth.immigrationOfficerLogin');
Route::get('bd-govt-login', 'Auth\CustomLoginController@bdGovtLogin')->name('auth.bdGovtLogin');
Route::get('super-admin', 'Auth\CustomLoginController@superAdminLogin')->name('auth.superAdminLogin');
Route::post('login/getOtp', 'Auth\CustomLoginController@getMyOTP');
Route::post('login/checkOtp', 'Auth\CustomLoginController@checkOtp');

// Route for center registration
Route::get('/center-register', 'Auth\CenterRegistrationController@centerRegister')->name('centerRegister');
Route::post('/center-register-data-store', 'Auth\CenterRegistrationController@centerRegisterDataStore')->name('centerRegisterDataStore');


Route::get('/share/user/{id}', 'ShareController@shareUser')->name('share.user');
Route::post('change-password', 'HomeController@changePassword')->name('changePassword');


// country -state - city list related api
Route::get('/api/get-state-list/{country_id}', 'Auth\CenterRegistrationController@getStateList');
Route::get('/api/get-city-list/{state_id}', 'Auth\CenterRegistrationController@getCityList');
