<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Validator;

class UserController extends Controller
{

    public function get_sign_up(){
      return view('users.sign_up');
    }

    public function get_login(){
        return view('users.login');
    }

    public function get_profile(){

        return view('users.profile', ['user' => Auth::user()]);
    }

    public function sign_up(Request $request){
        $validator = $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required|min:6',
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
                $user->name = $request->name;
                $user->email = $email;
                $user->password = $request->password;
                $request->file('photo')->move(public_path('images'), $request->file('photo')->getClientOriginalName());
                $user->photo = '/'.'images'.'/'.$request->file('photo')->getClientOriginalName();
                $user->type = $request->type;
                $user->gender = $request->gender;
                $user->save();
//              get the just signed in user
                $signed_up_user = User::where('email', $email)->first();
                Session::flash('message', 'Signed up successfully');
                Session::flash('flash_type', 'alert-success');
                return view('users.profile', ['user' => $signed_up_user]);
            }


    }

    public function update(Request $request,User $user, $id){

        $validator = $this->validate($request, [
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required|min:6',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);

//
////        update user
        $user = $user->where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $request->file('photo')->move(public_path('images'), $request->file('photo')->getClientOriginalName());
        $user->photo = '/'.'images'.'/'.$request->file('photo')->getClientOriginalName();
        $user->gender = $request->gender;

        $user->save();
        return redirect()->action('UserController@get_profile', ['user' => $user, 'id' => $user->id ])->withMessage('User successfully updated');

    }

    public function get_dashboard(){
        return view('dashboard.dashboard',['user' => Auth::user()]);
    }
}
