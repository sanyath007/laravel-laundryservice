<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Reservation;
use App\Maintenance;
use App\Vehicle;
use App\Driver;
use App\Location;
use App\Department;
use App\ReservePassenger;

class ReservationController extends Controller
{

	public function __construct () 
	{
		// $this->middleware('auth');
	}

	public function index () {
        return view('reservations.list', [
            'vehicles' => Vehicle::where(['status' => '1'])
                                ->with('cate')
                                ->with('type')
                                ->with('method')
                                ->with('manufacturer')
                                ->with('changwat')
                                ->with('vender')
                                ->with('fuel')
                                ->paginate(10),
            'reservations' => Reservation::with('user')
                                ->orderBy('from_date', 'DESC')
                                ->orderBy('reserve_date', 'ASC')
                                ->paginate(10)
        ]);
    }

    public function create () {
        return view('reservations.newform', [
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
                                ->paginate(10),
            'departments' => Department::all(),
        ]);
    }
    public function store (Request $request)
    {
        // var_dump($request);
        $d = new \DateTime(date('Y-m-d H:i:s'));
        $diffHours = new \DateInterval('PT7H');
        $passengers = explode(',', $request['passengers']);
        $passengerCount = ($passengers[0] != '') ? count($passengers) + 1 : count($passengers);

        $reserve = new Reservation();
        $reserve->reserve_date = $d->add($diffHours);
        $reserve->user_id = $request['user'];
        $reserve->department = $request['department'];
        $reserve->activity = $request['activity'];
        $reserve->location = $request['locationId'];
        $reserve->passengers = $passengerCount;
        $reserve->from_date = $request['from_date'];
        $reserve->from_time = $request['from_time'];
        $reserve->to_date = $request['to_date'];
        $reserve->to_time = $request['to_time'];
        $reserve->remark = $request['remark'];
        $reserve->approved = '0';
        
        if ($reserve->save()) {
            $reserveLastId = $reserve->id;
            
            //add user to passengers
            if ($request['chkUserIn'] == 'on') {
                $newPassenger = new ReservePassenger();
                $newPassenger->reserve_id = $reserveLastId;
                $newPassenger->person_id = $request['user'];
                $newPassenger->status = '1';
                $newPassenger->save();
            }

            if ($passengers[0] != '') {
                foreach ($passengers as $key => $value) {
                    $newPassenger = new ReservePassenger();
                    $newPassenger->reserve_id = $reserveLastId;
                    $newPassenger->person_id = $value;
                    $newPassenger->status = '2';
                    $newPassenger->save();
                }
            }

            return redirect('reserve/list');
        } else {
            return view('reservations.newform', [
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
    }

    public function cancel () {
        return view('reservations.list', [
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
                                ->paginate(10),
        ]);
    }

    public function calendar () {
        return view('reservations.calendar', [
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
                                ->paginate(10),
        ]);
    }

    public function ajaxcalendar ($sdate, $edate) {
        $events = [];
        $reservations = Reservation::with('vehicle')
                                ->with('driver')
                                ->with('user')
                                ->get();

        foreach ($reservations as $reserve) {
            $locationsText = '';
            $locationsIndex = explode(',', $reserve->location);

            foreach ($locationsIndex as $l) {
                $locations = Location::where(['id' => $l])->first();
                $locationsText .= $locations->name. ', '; 
            }
             
            $event = [
                'id'    => $reserve->id,
                'title' => $reserve->activity. ' ณ ' .$locationsText. 'จำนวน ' .$reserve->passengers. ' ราย',
                'start' => $reserve->from_date. 'T' .$reserve->from_time,
                'end'   => $reserve->to_date. 'T' .$reserve->to_time,
            ];

            array_push($events, $event);
        }

        return $events;
    }
}
