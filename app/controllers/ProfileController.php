<?php

class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		
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
		//
	}

  public function verifyBankAccount()
  {
    $data = Input::all();
    $id = $data['user_id'];
    
    $validator = Validator::make($data,[
           'bank_account' => 'required|digits_between:10,16'
    ]);

    if ($validator->fails() )
    {
      return Redirect::route('profile.show',$id)->withErrors($validator)->withInput();
    }
    
    $bank_details = Util::getAccount($data['bank_account']);

    if(!$bank_details || $bank_details->status != 'ACTIVE' ) 
    { 
      return Redirect::route('profile.show',$id)->withErrors(['errors'=>'Invalid Bank Account']);
    }

    $user = User::find($id);
    $user->bank_account = $bank_details->account_no;
    $user->save();

    sweetAlert('Verified', 'Bank Account Verified', '', 'success');
    return Redirect::route('profile.show',$id);


  }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$data = [
     'user' => User::find($id),
    ];

    return View::make('users.profile')->with($data);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
