<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseMothod extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'purchase_mothods';

  public function vehicle()
  {
      return $this->hasMany('App\Vehicle', 'id', 'purchase_mothod');
  }
}
