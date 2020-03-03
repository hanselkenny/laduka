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
// Route::prefix('register')->group(function(){
//     Route::get('/','Auth\RegisterController@Index');
// });
// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// hanya untuk tamu yg belum auth
Route::get('/login', 'Auth\LoginController@getLogin')->middleware('guest')->name('login');
Route::post('/login', 'Auth\LoginController@postLogin');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


//Registration route
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

//Admin Registration route
Route::get('/adminregister', 'Auth\AdminRegisterController@showRegistrationForm')->name('adminregister');
Route::post('/adminregister', ['as' => 'adminregister', 'uses' => 'Auth\AdminRegisterController@register']);

Route::get('/admin', function() {
  return view('admin');
})->middleware('auth:admin');

Route::get('/user', function() {
  return view('user');
})->middleware('auth:user');