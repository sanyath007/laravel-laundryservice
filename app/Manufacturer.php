<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'manufacturers';

  public function vehicle()
  {
      return $this->hasMany('App\Vehicle', 'manufacturer_id', 'manufacturer_id');
  }
}
