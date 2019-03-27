<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  protected $connection = 'hosxp';

  protected $table = 'doctor';
  
  public function operation()
  {
      return $this->hasMany('App\OperationList', 'request_doctor', 'code');
  }
}
