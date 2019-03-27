<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
  protected $connection = 'hosxp';

  protected $table = 'patient';
  
  public function operation()
  {
      return $this->hasMany('App\OperationList', 'hn', 'hn');
  }
}
