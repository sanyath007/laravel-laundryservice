<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentoutDaily extends Model
{
  	protected $table = 'sentout_daily';

  	public function sentoutdailydetail()
    {
        return $this->hasMany('App\SentoutDailyDetail', 'sentout_daily_id', 'id');
    }
}
