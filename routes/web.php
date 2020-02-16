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
  return view('post');
});
// Route::get('/{any}', function () {
//     return view('post');
//   })->where('any', '.*');
// Route::post('login', 'UserController@login');
// Route::post('register', 'UserController@register');  

Route::prefix('auth')->group(function () {
  Route::get('init','UserController@init');
  Route::post('login','UserController@login');
  Route::post('register','UserController@register');
  Route::post('logout','UserController@logout');
});