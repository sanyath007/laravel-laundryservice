<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentoutDailyDetailItem extends Model
{
  	protected $table = 'sentout_daily_detail_items';

  	public function sentoutdaily()
    {
        return $this->belongsTo('App\SentoutDaily', 'sentout_daily_id', 'id');
    }

    public function drape()
    {
        return $this->belongsTo('App\Drape', 'drape_id', 'id');
    }
}
