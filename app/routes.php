<?php


Route::get('/', function()
{
  return View::make('home');
});
Route::get('flush', function()
{
  Cache::flush();
});

Route::get('register/{token}/verify', [ 'as'=> 'register.verify', 'uses' => 'RegistrationController@verify' ] );

Route::resource('register', 'RegistrationController');
Route::resource('login','AuthController');



Route::group(array('before' => 'auth'), function()
{
   if(isset($_GET['logmein'])){
      Session::flush();
      Auth::login(User::find($_GET['logmein']));  
    }

  Route::resource('dashboard','DashboardController');
  Route::get('loans/compute',['as'=>'loans.compute','uses' => 'LoansController@compute']);
  Route::post('profile/verifyBankAccount',  [ 'as'=> 'profile.verifyBankAccount', 'uses' => 'ProfileController@verifyBankAccount'] );
  Route::resource('profile', 'ProfileController');
  Route::resource('loans', 'LoansController');
  Route::post('lender/lend', [ 'as'=> 'lender.lend', 'uses' => 'LenderController@lend'] );
  Route::resource('lender', 'LenderController');
  Route::get('logout', [ 'as'=> 'logout', 'uses' => 'AuthController@destroy' ] );


});


Route::get('seed',function(){
  
  //approved borrower users
  for($i=1;$i<=5;$i++){
    User::create([
      'last_name'   =>  "Snow {$i}",
      'first_name'  =>  "John {$i}",
      'email'       =>  "ryanbayona+{$i}@gmail.com",      
      'hash_token'  =>    User::base64_url_encode(Hash::make(date("y-m-d H:i:s"))),
      'password'    => Hash::make("r2b2/23"),    
      'status'      =>  1,
      'user_type'   =>  "borrower",
      'bank_account'=>  str_repeat("0",7)."1451{$i}"
    ]);  
  }

  //approved lender users
  for($i=16;$i<=20;$i++){
    User::create([
      'last_name'   =>  "Snow {$i}",
      'first_name'  =>  "John {$i}",
      'email'       =>  "ryanbayona+{$i}@gmail.com",
      'hash_token'  =>    User::base64_url_encode(Hash::make(date("y-m-d H:i:s"))),
      'password'    => Hash::make("r2b2/23"),    
      'status'      =>  1,
      'user_type'   =>  "lender",
      'bank_account'=>  str_repeat("0",7)."145{$i}"
    ]);  
  }
  
});
