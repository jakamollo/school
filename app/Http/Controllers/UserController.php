<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Traits\FileUploads;

use Validator;

class UserController extends Controller
{

    # The construct function
    public function _construct(User $user){
        $this->user = $user;
    }
    public function get_sign_up(){
      return view('users.sign_up');
    }

    public function get_login(){
        return view('users.login');
    }

    public function get_profile(){

        return view('users.profile', ['user' => Auth::user()]);
    }

    public function sign_up(Request $request,FileUploads $fileUploads){
        # Validate request
        $validator = $this->validate($request, [
            'username' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);

                $user = new User();
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = $request->password;
                # Upload and save the user photo to the database
                $fileUploads->photoUpload($request, 'photo', $user );
                $user->type = $request->type;
                $user->gender = $request->gender;
                $user->save();
                # get the just signed in user
                $signed_in_user = Auth::user();
                Session::flash('message', 'Signed up successfully');
                Session::flash('flash_type', 'alert-success');
                return view('users.profile', ['user' => $signed_in_user]);
    }

    public function update(Request $request,User $user,FileUploads $fileUploads, $id){
        # Validate request
        $validator = $this->validate($request, [
            'username' =>'required',
            'email' =>'required|email',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);

        # update user record
        $user = $user->where('id', $id)->first();
        $user->username = $request->username;
        $user->email = $request->email;
        # Upload and save the photo to the database
        $fileUploads->photoUpload($request, 'photo', $user );
        $user->gender = $request->gender;
        $user->save();
        return redirect()->action('UserController@get_profile', ['user' => $user, 'id' => $user->id ])->with(['flash_type' => 'success','message' => 'User successfully updated']);

    }

    public function get_dashboard(){
        return view('dashboard.dashboard',['user' => Auth::user()]);
    }

    public function change_password(Request $request,User $user, $id){

            # Validate request
            $this->validate($request, [
                'new_password' => 'required|string|min:6',
                'password_confirmation' => 'required|same:new_password',
            ]);

            # Update the password with the new password
            $new_password = bcrypt($request->new_password);
            $user->find($id)->update(['password' => $new_password]);

            return back()->with(['flash_type' => 'success', 'message' => 'Password successfully changed']);


    }
}
