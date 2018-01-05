<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReservePassenger;
use App\Position;
use App\User;

class ReservePassengerController extends Controller
{
    public function ajaxpassenger ($reserveid) {
        $passengers = ReservePassenger::where(['reserve_id' => $reserveid])
        						// ->where(['status' => '2'])
        						// ->with('reserve')
        						// ->with('user')
                                ->get();

        $users = [];
        foreach ($passengers as $passenger) {
	        $user = User::where(['person_id' => $passenger->person_id])
	        			->with('position')
	        			->with('academic')
	        			->first();

	    	// var_dump($user);
	    	$academic = ($user->ac_id > 0) ? $user->academic->ac_name : '';

	       	array_push($users, [
	       		'id' => $user->person_id, 
	       		'name' => $user->person_firstname. ' ' .$user->person_lastname,
	       		'position' => $user->position->position_name. '' .$academic,
	       	]);
        }
	    
	    // var_dump($users);
        return $data = [
        	$passengers, 
        	$users
        ];
    }
}
