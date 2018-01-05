<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Changwat extends Model
{
  	protected $connection = 'vehicle';

  	protected $table = 'changwat';

  	public function vehicle()
  	{
      	return $this->hasMany('App\Vehicle', 'reg_chw', 'chw_id');
  	}
}
