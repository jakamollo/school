<?php

namespace App\Http\Controllers;

use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Traits\FileUploads;

class StudentController extends Controller
{
    public function post_student(Request $request){
    // run validator
        $this->validates($request);
        // email already exist?
        $student_exist = Student::where('email', $request->email)->first();
        if(isset($student_exist)){
            Session::flash('message', 'A student with that email already exist.');
            Session::flash('flash_type', 'alert-danger');
            return redirect()->back()->withInput();
        }else{
            $student = new Student();
            $student->first_name = $request->first_name;
            $student->last_name = $request->last_name;
            $student->email = $request->email;
            $student->gender = $request->gender;
            $student->age = $request->age;
            $student->form = $request->form;
            $student->admission_date = Carbon::createFromFormat('d-m-Y', $request->admission_date);
            $student->school_id = $request->school_id;
            $student->save();
            Session::flash('message', 'Student successfully added');
            Session::flash('flash_type', 'alert-success');
            return redirect()->back();
        }
    }

    public function validates($request){
        $validator = $this->validate($request, [
            'first_name' =>'required|string|max:255',
            'last_name' => 'required|string',
            'email' =>'required|string|email|max:255',
            'gender' => 'required|string',
            'age' => 'required|integer',
            'form' => 'required|string',
            'admission_date' => 'required|string',

        ]);
        return $validator;
    }

    public function get_register(){
        return view('student.register');
    }

    public function post_register(Request $request, FileUploads $fileUploads){
     // validate input
        $this->validateStudent($request);
        // confirm email existence in students records
        $email_exist = Student::where('email', $request->email)->first();
        if(isset($email_exist)){
            $user_ixist = User::where('email', $request->email)->first();
            if(isset($user_ixist)){
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

    public function validateStudent($request){
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
}
