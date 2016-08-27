<?php

use Carbon\Carbon;

class RegistrationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('registrations/registration');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
    $data = Input::all();
	  $validator = User::validate($data);
   
    if ($validator->fails())
    {
      return Redirect::to('register')->withErrors($validator)->withInput();
    }
  
    $user = new User();
    $user->first_name = $data['first_name'];
    $user->last_name  = $data['last_name'];
    $user->email      = $data['email'];
    $user->password   = Hash::make($data['password']);
    $user->hash_token = User::base64_url_encode(Hash::make(Carbon::now()));
    $user->save();

    
    Mail::send('emails.email_verification',[ 'user' => $user ], function($message) use ($user)
    {
      $message->to($user->email, $user->first_name)->subject('Verify Email');
      
    });

    sweetAlert('Verify Email', 'Please check email for verification', '', 'success');
    return Redirect::to('register');
      

	}

  public function verify($token)
  {
   
    $is_valid = User::where('hash_token',$token)->count();
   
    if(!$is_valid){
      sweetAlert('Invalid Token', 'Token is not valid or expired.', '', 'error');
      return Redirect::to('register');
    }

   // return View::make('registrations/verify');

  }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
    
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
