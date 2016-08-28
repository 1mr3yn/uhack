<?php

use Carbon\Carbon;
class AdminController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data = [
     'users' => User::where('user_type','!=','admin')->get(),
    ];
    return View::make('admin/home')->with($data);
	}

  public function attachment()
  {

    $data = Input::all();
    $doc = Attachment::find($data['id']);
    $doc->status = $data['action'];
    $doc->approved_at = Carbon::now();
    $doc->approved_by = Auth::user()->id;
    $doc->note = $data['note'];
    $doc->save();

    // if($doc->status)
    // {
    //   sweetAlert('Approved!', 'User document approved', '', 'success');
    // }else{
    //   sweetAlert('Declined!', 'Documend has been declined', '', 'info');
    // }

    return $doc;

    

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


}
