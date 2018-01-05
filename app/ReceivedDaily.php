<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceivedDaily extends Model
{
    protected $table = 'received_daily';

    public function receiveddailydetail()
    {
        return $this->hasMany('App\ReceivedDailyDetail', 'received_daily_id', 'id');
    } 

  // public function garage()
  // {
  //   return $this->belongsTo('App\Garage', 'garage_id', 'garage_id');
  // }

  // public function user()
  // {
  //   return $this->belongsTo('App\User', 'staff', 'person_id');
  // }

  // public function bringDetail()
  // {
  //   return $this->hasMany('App\BringDetail', 'bring_id', 'id');
  // }
}
