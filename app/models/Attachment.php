<?php

class Attachment extends Eloquent {

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = 'attachments';

  protected $fillable = [
    'user_id',
    'file_type', //itr, coe, goverment_id, payslip, bills_payment, 
    'file_path',
    'status', // 0 = pending, -1 = declined, 1 = approved
    'approved_at', 
    'approved_by',
    'note'

  ];


  public function user(){
    return $this->belongsTo('User');
  }

  public function getStatusAttribute($value)
  {
    $status = [
     '0'  => 'pending',
     '-1' => 'declined',
     '1'  => 'approved'
    ];
   
    return $status[$value];
  }
  


}
