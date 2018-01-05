<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function ajaxperson ($name) {
        if(empty($name)){
            $persons = User::with('position')->with('department')->all();
        }else{
            $persons = User::where('person_firstname', 'like', '%' .$name. '%')
                            ->with('position')
                            ->with('department')
                            ->get();
        }

        $users = [];
        foreach ($persons as $person) {
            array_push($users, [
                'id' => $person->person_id,
                'name' => $person->person_firstname. ' ' .$person->person_lastname,
                'position' => $person->position->position_name,
                'department' => $person->department->ward_name,
            ]);
        }

        return $users;
    }
}
