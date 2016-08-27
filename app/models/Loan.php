<?php

class Loan extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'loans';

  protected $fillable = [
    'user_id',
    'modified_by',
    'term',
    'amount',
    'status',
    'remarks'
  ];

  public function user(){
    return $this->belongsTo('User');
  }
  public function lenders(){
    return $this->hasMany('LenderLoan');
  }



  public static function validate($input =[]){
    
    $validate = Validator::make($input,[
      'amount'=> "required|integer|min:20000|max:200000", 
      'term'  => "required|integer|max:48"
    ]);
    return $validate;
  }
  public function compute(){
    return Util::compute_loan($this->amount,$this->term);
  }

  public function formatted_amount($user_amount = null){
    return number_format( !empty($user_amount) ? $user_amount : $this->amount,2);
  }


}
