<?php

class Loan extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'attachments';

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
  


}
