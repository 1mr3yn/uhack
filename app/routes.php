<?php


Route::get('/', function()
{
  return View::make('home');
});

Route::get('register/{token}/verify', [ 'as'=> 'register.verify', 'uses' => 'RegistrationController@verify' ] );
Route::resource('register', 'RegistrationController');
Route::resource('login','AuthController');


Route::resource('dashboard','DashboardController');
Route::get('loans/compute',['as'=>'loans.compute','uses' => 'LoansController@compute']);
Route::resource('loans', 'LoansController');
