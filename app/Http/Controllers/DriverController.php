<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Driver;

class DriverController extends Controller
{
    public function index () {
        return view('drivers._list', [
            'drivers' => Driver::where(['status' => '1'])->with('person')->get()
        ]);
    }
}
