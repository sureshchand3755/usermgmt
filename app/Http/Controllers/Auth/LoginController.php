<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }
    /** index page login */
    public function login()
    {
        return view('auth.login');
    }

    /** login with databases */
    public function authenticate(Request $request)
    {
        try {

            $request->validate([
                'username' => 'required|string',
                'password' => 'required|string',
            ]);

            $username  = $request->username;
            $password  = $request->password;

            if (Auth::attempt(['email'=>$username,'password'=>$password])) {
                Toastr::success('Login successfully :)','Success');
                return redirect()->intended('user/list');
            } else {
                Toastr::error('fail, WRONG USERNAME OR PASSWORD :)','Error');
                return redirect('login');
            }

        } catch(\Exception $e) {
            Toastr::error('fail, LOGIN :)','Error');
            return redirect()->back();
        }
    }

    /** logout */
    public function logout( Request $request)
    {
        Auth::logout();
        // forget login session
        $request->session()->forget('name');
        $request->session()->forget('email');
        $request->session()->forget('user_id');
        $request->session()->forget('join_date');
        $request->session()->forget('phone_number');
        $request->session()->forget('status');
        $request->session()->forget('role_name');
        $request->session()->forget('avatar');
        $request->session()->forget('position');
        $request->session()->forget('department');
        $request->session()->flush();

        Toastr::success('Logout successfully :)','Success');
        return redirect('login');
    }

}
