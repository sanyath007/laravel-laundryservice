<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    protected $username = 'person_username';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLogin ()
    {
        return view('auth.login');
    }

    public function doLogin(Request $req)
    {
        //validate the form data

        //attempt to log the user in
        $credentials = $req->only('person_username', 'person_password');       
        if (Auth::attempt($credentials, $req['remember'])) {
            //if successful, then redirect to their intended location
            return redirect()->intended('home');
        } else { 
            //if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()->withInput([$req->only('person_username', 'remember')]);
        }
    }

    public function doLogout()
    {
        Auth::logout(); // logging out user
        return redirect('auth/login'); // redirection to login screen
    }
}
