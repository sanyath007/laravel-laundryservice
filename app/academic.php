<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
  	protected $connection = 'person';
  	protected $table = 'academic';

  	public function user()
    {
        return $this->hasMany('App\User', 'ac_id', 'ac_id');
    }
}
