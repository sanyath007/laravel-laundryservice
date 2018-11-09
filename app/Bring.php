<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bring extends Model
{

  	protected $table = 'bring';

  	public function detail()
  	{
  	     return $this->hasMany('App\BringDetail', 'id', 'bring_id');
  	}
}
