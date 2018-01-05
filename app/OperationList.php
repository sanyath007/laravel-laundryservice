<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OperationList extends Model
{
  protected $connection = 'hosxp';

  protected $table = 'operation_list';
  
  public function patient()
  {
      return $this->belongsTo('App\Patient', 'hn', 'hn');
  }  

  public function doctor()
  {
      return $this->belongsTo('App\Doctor', 'request_doctor', 'code');
  }
}
