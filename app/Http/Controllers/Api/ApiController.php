<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use App\User;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['auth']]);
    }

    public function index()
    {
        return User::all();
    }

    public function signup(Request $req)
    {
        $credentials = $req->all();

        try {
            $user = User::create($credentials);
        } catch (JWTException $e) {
            return response()->json(['error' => 'User already exists.'], 401);
        }

        $token = JWTAuth::fromUser($user);
        return response()->json(compact('token'));
    }

    public function auth(Request $req)
    {
        $this->validate($req, [
            'person_username' => 'required',
            'person_password' => 'required'
        ]);

        $credentials = $req->only('person_username', 'person_password');
        
        try {
            // verify the credentials and create a token for user
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'Invalid credentials.'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token.'], 500);
        }
        
        /** ดึงข้อมูล user จากตาราง personal */
        $person         = User::where($req->only('person_username'))->first();
//        $person_name    = $person->person_firstname . '  ' . $person->person_lastname;
        $useronline     = $person->person_id;
//        [
//            'person_id'     => $person->person_id, 
//            'person_name'   => $person_name,
//            'position'      => $person->position_id,
//            'department'     => $person->office_id,
//        ];
        
        return response()->json(compact('token', 'useronline'));
    }

//    public function online($id)
//    {
//        return User::with('department')->where(['person_id' => $id])->first();
//    }
}
