<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleType extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'vehicle_types';

  public function vehicle()
  {
      return $this->hasMany('App\Vehicle', 'vehicle_type_id', 'vehicle_type');
  }
}
