<?php


Route::get('/', function()
{
  return View::make('home');
});

Route::get('register/{token}/verify', [ 'as'=> 'register.verify', 'uses' => 'RegistrationController@verify' ] );

Route::resource('register', 'RegistrationController');
Route::resource('login','AuthController');


Route::group(array('before' => 'auth'), function()
{

  Route::resource('dashboard','DashboardController');
  Route::get('loans/compute',['as'=>'loans.compute','uses' => 'LoansController@compute']);
  Route::post('profile/verifyBankAccount',  [ 'as'=> 'profile.verifyBankAccount', 'uses' => 'ProfileController@verifyBankAccount'] );
  Route::resource('profile', 'ProfileController');
  Route::resource('loans', 'LoansController');
  Route::resource('lender', 'LenderController');
  Route::get('logout', [ 'as'=> 'logout', 'uses' => 'AuthController@destroy' ] );


});

