<?php

class LenderController extends \BaseController {

	public function __construct(){
		
		$this->beforeFilter('@checkUserAccess');
		//parent::__construct();
	}

	/**
	 * Display a listing of the resource.
	 * 
	 * @return Response
	 */
	public function index()
	{
		//lists all available loan applications!
		//this should be further filtered with loans that has incomplete lenders
		$loans = Loan::orderBy('created_at','desc')->get();
		return View::make('loans.lend.index',['loans'=>$loans]);
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


	//only lenders should access this page
	public function checkUserAccess(){
		if(Auth::user()->user_type !='lender'){
			return Redirect::intended("dashboard");
		}
		//return true;

	}

	public function lend(){		

		$loan = Loan::find(Input::get('loan_id'));
		$amount = Input::get('amount');

		//saving 
		LenderLoan::create([
			'lender_id' => Auth::user()->id, 
			'loan_id'  =>	$loan->id,	
			'amount'		=> $amount
		]);

		//notify borrower via email

		//modify cached user account available balance
		$account = Auth::user()->account();
		
		if($account->avaiable_balance - $amount < 0){
			return Response::json([
				'success'=>false,
				'message' => "Insufficient Balance"
			]);
		}
		Cache::forever($account->account_no,$account);
		return Response::json([
			'success'=>true,
			'available_balance' => "PHP ".number_format($account->avaiable_balance,2)
		]);

	}

	public function backout(){

	}

}
