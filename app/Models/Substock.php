<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Substock extends Model
{
    protected $table = 'substocks';

    // public function cate()
    // {
    //     return $this->belongsTo('App\VehicleCate', 'vehicle_cate', 'vehicle_cate_id');
    // }

    // public function type()
    // {
    //     return $this->belongsTo('App\VehicleType', 'vehicle_type', 'vehicle_type_id');
    // }

    // public function method()
    // {
    //     return $this->belongsTo('App\PurchaseMothod', 'purchase_mothod', 'id');
    // }

    // public function manufacturer()
    // {
    //     return $this->belongsTo('App\Manufacturer', 'manufacturer_id', 'manufacturer_id');
    // }

    // public function changwat()
    // {
    //     return $this->belongsTo('App\Changwat', 'reg_chw', 'chw_id');
    // }

    // public function vender()
    // {
    //     return $this->belongsTo('App\Vender', 'vender_id', 'vender_id');
    // }

    // public function fuel()
    // {
    //     return $this->belongsTo('App\FuelType', 'fuel_type', 'fuel_type_id');
    // }

    // public function reserve()
    // {
    //     return $this->hasMany('App\Reservation', 'vehicle_id', 'vehicle_id');
    // }

    // public function maintained()
    // {
    //     return $this->hasMany('App\Maintenance', 'vehicle_id', 'vehicle_id');
    // }
}
