<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vehicle;
use App\Driver;

class VehicleController extends Controller
{
    public function index () {
        return view('vehicles._list', [
            'vehicles' => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10)
        ]);
    }
}
