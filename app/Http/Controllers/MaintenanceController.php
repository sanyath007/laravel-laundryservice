<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Vehicle;
use App\Maintenance;

class MaintenanceController extends Controller
{
    public function index () {
        return view('maintenances._list', [
            'vehicles' => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10),
            'maintenances' => Maintenance::with('vehicle')
                                ->with('garage')
                                ->with('user')
                                ->paginate(10)
        ]);
    }

    public function vehiclemaintain ($id) {
        return view('maintenances.vehicle', [
            'vehicle' => Vehicle::where(['vehicle_id' => $id])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10),
            'maintenances' => Maintenance::where(['vehicle_id' => $id])
                                ->with('vehicle')
                                ->with('garage')
                                ->with('user')
                                ->orderBy('maintain_date', 'DESC')
                                ->paginate(10)
        ]);
    }
}
