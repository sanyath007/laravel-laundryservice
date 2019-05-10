<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Drape extends Model
{

  	protected $table = 'drapes';

  	// public function person()
  	// {
  	//     return $this->belongsTo('App\User', 'person_id', 'person_id');
  	// }

  	public function stock()
  	{
      	return $this->hasMany('App\Models\StockDetail', 'id', 'drape_id');
  	}

  	public function dispose()
  	{
      	return $this->hasMany('App\Models\Dispose', 'id', 'drape_id');
  	}
}
