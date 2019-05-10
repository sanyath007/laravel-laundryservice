<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispose extends Model
{
    protected $table = 'dispose_detail';

    public function drape()
  	{
      	return $this->belongsTo('App\Models\Drape', 'drape_id', 'id');
  	}
}
