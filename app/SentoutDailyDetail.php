<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentoutDailyDetail extends Model
{
  	protected $table = 'sentout_daily_detail';

  	public function sentoutdaily()
    {
        return $this->belongsTo('App\SentoutDaily', 'sentout_daily_id', 'id');
    }

    public function sentouttype()
    {
        return $this->belongsTo('App\SentoutType', 'sentout_type_id', 'sentout_type_id');
    }
}
