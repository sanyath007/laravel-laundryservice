<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedDailyDetail extends Model
{
  	protected $table = 'received_daily_detail';

  	public function receiveddaily()
    {
        return $this->belongsTo('App\ReceivedDaily', 'received_daily_id', 'id');
    }

    // public function vehicle()
  	// {
  	//   return $this->belongsTo('App\Vehicle', 'vehicle_id', 'vehicle_id');
  	// } 
}
