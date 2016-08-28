<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Carbon\Carbon;

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
    'credit_score',
    'remember_token',
    'hash_token',
    'bank_account',
    'user_type'
  ];

  public function attachments(){
    return $this->hasMany('Attachment'); 
  }

  public function loans(){
    return $this->hasMany('Loan'); 
  }

  //itr, coe, goverment_id, payslip, bills_payment,
  public function itr()
  {
    return $this->hasMany('Attachment')->where('file_type','itr');
  }

  public function coe()
  {
    return $this->hasMany('Attachment')->where('file_type','coe');
  }

  public function goverment_id()
  {
    return $this->hasMany('Attachment')->where('file_type','goverment_id');
  }

  public function payslip()
  {
    return $this->hasMany('Attachment')->where('file_type','payslip');
  }

  public function bills_payment()
  {
    return $this->hasMany('Attachment')->where('file_type','bills_payment');
  }

  public static function progress($user)
  { 
      $progress = 0;
      $doc_types = ['itr', 'coe', 'goverment_id', 'payslip', 'bills_payment']; 

      if ($user->bank_account) 
      {
        $progress += 50;
      }
      
      foreach ($doc_types as $key) 
      {
        $p = $user->$key()->where('status',1)->first();
        if($p['status']){
          $progress += 10;
        }
      }

     return $progress;

  }


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');


  public static function cleanURL($string) 
  {
     return substr(strtr(base64_encode($string), '+/=', '-_,'), 0,59);
  }


  public static function validate($data)
  {
    
    $rules = [
      'user_type' => 'required',
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed',
      'password_confirmation' => 'required',
      'terms' => 'required'
    ];

    return Validator::make($data,$rules);

  }

  public function name(){
    return "{$this->first_name} {$this->last_name}";
  }

  public function account(){
    return Util::getAccount($this->bank_account);
  }

  public function credit_score(){
     return $this->credit_score;
  }



}
