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

  // public function reservation()
  // {
  //     return $this->hasMany('App\Reservations', 'driver_id', 'driver_id');
  // }
}
