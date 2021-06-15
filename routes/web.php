<?php

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

// Home Page Route
Route::get('/', 'App\Http\Controllers\PhoneNumberController@index')->name('all-numbers');

// Pagination Route
Route::get('/paginate', 'App\Http\Controllers\PhoneNumberController@traversPages')->name('pagination-route');

// Filter Numbers Route
Route::post('/filternumbers', 'App\Http\Controllers\PhoneNumberController@filterPhones')->name('filter-numbers');
