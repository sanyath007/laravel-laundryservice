<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockDetail extends Model
{

  protected $table = 'stock_detail';

  public function drape()
  {
      return $this->belongsTo('App\Drape', 'drape_id', 'id');
  }
}
