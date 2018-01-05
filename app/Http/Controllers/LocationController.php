<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Location;

class LocationController extends Controller
{
    public function ajaxquery ($location)
    {
        if(empty($location)){
            $locations = Location::where('id', '<>', '1')->get();
        }else{
            $locations = Location::where('name', 'like', '%' .$location. '%')
                                    ->where('id', '<>', '1')
                                    ->get();
        }

        return $locations;
    }
}
