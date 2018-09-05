<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/login', 'LoginController@index')->name('admin.login.index');
Route::post('/login', 'LoginController@store')->name('admin.login.store');

Route::group([
   'middleware' => 'admin'
], function ($router) {
    $router->get('/dashboard', 'HomeController@index')->name('admin.home.index');

});