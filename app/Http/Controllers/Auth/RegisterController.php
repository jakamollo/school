<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use App\Traits\FileUploads;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)

    {

    }

    protected function post_signup(Request $request, FileUploads $fileUploads){
        $validator = $this->validate($request, [
            'username' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);


        $email = $request->email;
//        check if there is a user with the email above
        $existed_user = User::where('email', $email)->first();
        if(isset($existed_user)){
            return redirect()->back()->withMessage('The email already exist!')->withInput();
        }else{
            $user = new User();
            $user->username = $request->username;
            $user->email = $email;
            $user->password = bcrypt($request->password);
            $fileUploads->photoUpload($request, 'photo', $user );
            $user->type = $request->type;
            $user->gender = $request->gender;
            $user->confirmed = $request->confirmed;
            $user->save();
//              get the just signed in user
            $signed_up_user = User::where('email', $email)->first();
            Session::flash('message', 'Signed up successfully');
            Session::flash('flash_type', 'alert-success');
            return redirect()->action('Auth\LoginController@showLoginForm');
        }
    }

    public function get_signup(){
        return view('auth.register');
    }

}