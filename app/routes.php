<?php


Route::get('/', function()
{
  return View::make('home');
});

Route::get('register/{token}/verify', [ 'as'=> 'register.verify', 'uses' => 'RegistrationController@verify' ] );
Route::resource('register', 'RegistrationController');
Route::resource('login','AuthController');

