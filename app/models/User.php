<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

  protected $fillable = [
    'first_name',
    'last_name',
    'email',
    'password',
    'status',
    'credit_score'
  ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


  public static function validate($data)
  {
    
    $rules = [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required',
    ];

    return Validator::make($data,$rules);




  }



}
