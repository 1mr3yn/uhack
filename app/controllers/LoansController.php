<?php

class LoansController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		
		//if the user has active loans, he cannot post any more loans
		// unless he cancels this loan request

		$has_loans = Loan::where("user_id",2)->where("status","<>",2)->get();

		if($has_loans->count() > 0){						
			return View::make("loans.show",['the_flash'=> Session::get('the_flash')]);
		}
		return View::make('loans.index');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//validate 
		$validation = Loan::validate(Input::only('amount','term'));

		if($validation->fails()){
			return Redirect::to(route('loans.index'))->withErrors($validation)->withInput();
		}
		//save 
		$params = Input::all();
		$params['user_id'] = 2;
		$params['status']  = 0;

		$loan = Loan::create($params);
		Session::flash('the_flash','Your loan application has been submitted.!');
		return Redirect::to(route('loans.index')."?id={$loan->id}");
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
	public function compute(){
		$params = Input::only('amount','terms');
		$terms	= 	empty($params['terms']) ? 12 : (int)$params['terms'];
		$amount= 	empty($params['amount']) ? 20000 : (int)$params['amount']; //defaults to 20000
				
		$table = ["<table class='table table-striped'><tbody><tr><th colspan=8>Loan Amount</th><td>".number_format($amount)."</td></tr>"];
		

		//provide calculations for different terms if used did not select loan term
		if(empty(Input::get('terms'))){

			$table[] = "<tr><th>Term (months)</th>";
			foreach(Util::terms() as $months => $label){
				$table[] = "<td>".$months."</td>";
			}

			$table[] = "</tr>";
			$table[] = "<tr><th>Monthly Installment</th>";
			foreach(Util::terms() as $months => $label){
				$table[] = "<td>".number_format(round(Util::compute_loan($amount,$months),2))."</td>";
			}
			$table[] = "</tr>";
		}

		$table[] ='</tbody></table>';

		return Response::json(['success'=>true, 'content'=> implode("\n",$table)]);


	}

}
