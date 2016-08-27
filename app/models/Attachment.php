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
    'file_path',
    'file_path'
  ];

  public function user(){
    return $this->belongsTo('User');
  }
  


}
