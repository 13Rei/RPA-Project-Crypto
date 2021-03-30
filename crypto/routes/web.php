<?php


use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileEdit;
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

Route::get('/', [PagesController::class, "index"]);

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/edit', 'ProfileEdit@edit')->name('user.edit');
Route::patch('/profile/update', 'ProfileEdit@update')->name('user.update');