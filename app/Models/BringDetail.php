<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BringDetail extends Model
{

  protected $table = 'bring_detail';

  public function bring()
  {
      return $this->belongsTo('App\Bring', 'id', 'bring_id');
  }
}
