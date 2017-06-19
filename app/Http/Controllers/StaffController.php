<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Traits\FileUploads;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\User;

class StaffController extends Controller
{
    public function post_staff(Request $request){
// run validator
        $this->validateStaff($request);
        // email already exist?
        $staff_exist = Staff::where('email', $request->email)->first();
        if(isset($staff_exist)){
            Session::flash('message', 'A staff member with that email already exist.');
            Session::flash('flash_type', 'alert-danger');
            return back()->withInput();
        }else{
            $all_staff = Staff::all();
            if($all_staff->has(0)){
                foreach($all_staff as $staff){
                    if($staff->management_level == 'principal' && $request->management_level == 'principal'){
                        Session::flash('message', 'A principal has already been added for this school');
                        Session::flash('flash_type', 'alert-danger');
                        return back()->withInput();
                    }
                }
               $this->create_staff($request);
                return back();
            }else{
                $this->create_staff($request);
                return back();
            }

        }
    }

    public function validateStaff($request){
        $validator = $this->validate($request, [
            'first_name' =>'required|string|max:255',
            'last_name' => 'required|string',
            'email' =>'required|string|email|max:255',
            'gender' => 'required|string',
            'age' => 'required|integer',
            'type' => 'required|string',
            'management_level' => 'required|string',
            'joining_date' => 'required|string',
            'professional_qualifications' => 'required|string',


        ]);
        return $validator;
    }

    public function validateStaffReg($request){
        $validator = $this->validate($request, [
            'username' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password',
            'photo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'gender' => 'required',
        ]);
        return $validator;
    }

    public function create_staff($request){
        $staff = new Staff();
        $staff->first_name = $request->first_name;
        $staff->last_name = $request->last_name;
        $staff->email = $request->email;
        $staff->gender = $request->gender;
        $staff->age = $request->age;
        $staff->type = $request->type;
        $staff->management_level = $request->management_level;
        $staff->joining_date = Carbon::createFromFormat('d-m-Y', $request->joining_date);
        $staff->professional_qualifications = $request->professional_qualifications;
        $staff->school_id = $request->school_id;
        $staff->save();
        Session::flash('message', 'Staff successfully added');
        Session::flash('flash_type', 'alert-success');
    }

    public function get_register(){
        return view('staff.register');
    }

    public function register_staff(Request $request, FileUploads $fileUploads){
        // validate input
        $this->validateStaffReg($request);
        // confirm email existence in students records
        $email_exist = Staff::where('email', $request->email)->first();
        if(isset($email_exist)){
            $user_exist = User::where('email', $request->email)->first();
            if(isset($user_exist)){
                Session::flash('message', 'The email is already confirmed!');
                Session::flash('flash_type', 'alert-danger');
                return redirect()->back()->withInput();
            }else{
                $user = new User();
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $fileUploads->photoUpload($request, 'photo', $user );
                $user->type = $request->type;
                $user->gender = $request->gender;
                $user->confirmed = $request->confirmed;
                $user->school_id = $email_exist->school->id;
                $user->save();
//              get the just signed in user
                $signed_up_user = User::where('email', $request->email)->first();
                Session::flash('message', 'Signed up successfully. Please sign in');
                Session::flash('flash_type', 'alert-success');
                return redirect()->action('Auth\LoginController@showLoginForm');
            }
        }else{

            Session::flash('message', 'Sorry, you have not been added to any school');
            Session::flash('flash_type', 'alert-danger');
            return redirect()->back()->withInput();
        }
    }
}
