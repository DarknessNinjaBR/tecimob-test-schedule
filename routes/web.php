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

Route::get('login', 'LoginController@index')->name('login');
Route::post('login', 'LoginController@authenticate')->name('login.auth');

Route::post('logout', 'LoginController@logout')->name('logout');

Route::get('/', 'ContactController@index')->name('home');
Route::get('/desc', 'ContactController@index');


Route::get('register', 'RegisterController@index')->name('register');
Route::post('register', 'RegisterController@register')->name('register.store');


Route::resource('contact', 'ContactController');

Route::put('edit_contact', 'ContactController@update')->name('edit_contact');

/*Route::prefix('contact')->group(function(){

    Route::post('register', 'ContactController@register')->name('contact.store');
    Route::put('edit', 'ContactController@update')->name('contact.update');

});*/

