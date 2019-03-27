<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
  	protected $connection = 'person';
  	protected $table = 'position';

  	public function user()
    {
        return $this->hasMany('App\User', 'position_id', 'position_id');
    }
}
