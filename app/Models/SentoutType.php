<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SentoutType extends Model
{
  	protected $table = 'sentout_type';

  	public function sentoutdailydetail()
    {
        return $this->hasMany('App\SentoutDailyDetail', 'sentout_type_id', 'sentout_type_id');
    }
}
