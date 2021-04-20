<?php

use Carbon\Carbon;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileEdit;
//use App\Http\Controllers\GoogleSocialiteController;
use App\Http\Controllers\GoogleController;
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
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/index', function(){
    return view('pages.index');
});

Route::get('/profile/edit', 'ProfileEdit@edit')->name('user.edit');
Route::patch('/profile/update', 'ProfileEdit@update')->name('user.update');
Route::get('/profile/deletecurrencies', 'ProfileEdit@deleteAllByUser')->name('user.deletecurrencies');
// Route::get('auth/google', [GoogleSocialiteController::class, 'redirectToGoogle']);
// Route::get('callback/google', ["GoogleSocialiteController@handleCallback"]);
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('callback/google', [GoogleController::class, 'handleCallback']);
// Route::get('callback/google', function(){
//     echo "Hello world";
// });

Route::get('/time', function(){
    // echo Carbon::now();
    echo date('Y-m-d H:i:s');
});

Route::post('/insertCurrencies', function(){
    $data=file_get_contents('../data.json');
    $array_of_data = json_decode($data, true);
    foreach ($array_of_data as $row) {
        echo $row;
        echo "<br>";
    }
});