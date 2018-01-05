<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $connection = 'person';

    protected $table = 'ward';

    public function reserve()
    {
        return $this->hasMany('App\Bring', 'ward_id', 'department');
    }
  
    public function user()
    {
        return $this->hasMany('App\User', 'ward_id', 'office_id');
    }
}
