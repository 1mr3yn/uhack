<?php

class LenderLoan extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'lender_loan';
  protected $fillable = [
    'lender_id',
    'loan_id',
    'amount'
  ];

  public function loan(){
    return $this->belongsTo('Loan');
  }
}
