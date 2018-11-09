<?php

namespace App;

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
      return $this->hasMany('App\StockDetail', 'id', 'drape_id');
  }
}
