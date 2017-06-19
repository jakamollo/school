<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


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
    protected $redirectTo = '/user/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('auth');
//        $this->guard = $guard;
    }

    public function get_login(){
        return view('auth.login');
    }

    public function post_login(Request $request, User $user){
//         make validation rules
//        $validator = $this->validate($request,[
//            'email' => 'required|email',
//            'password' => 'required'
//        ]);


//            get user inputs
        $email = $request->email;
        $password = $request->password;

//            check if email and password match
        $user_exist = $user->where('email', $email)->where('password', $password)->first();
//        if(isset($user_exist)){
//            // get all users
//            $users = $user->all();
//
//            return view('users.profile', ['user' => $user_exist]);
//        }else{
//            return back()->withMessage('Please check your email/password');
//        }
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            // Authentication passed...
            return view('users.profile', ['user' => $user_exist]);
        }else{
            return back()->withMessage('Please check your email/password');
        }

//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            return redirect()->route('get_profile', ['user' => $user_exist]);
//        } else {
//            Session::flash('message','Please check your email/password');
//            Session::flash('flash_type','alert-danger');
//            return back();
//        }
    }

}
