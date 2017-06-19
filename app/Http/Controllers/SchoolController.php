<?php

namespace App\Http\Controllers;

use App\School;
use App\Traits\FileUploads;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class SchoolController extends Controller
{

    public function register_school(Request $request, School $school, FileUploads $fileUploads){
        $this->validates($request);
//        check if there is a school with the email above
        $existed_school = School::where('email',$request->email)->first();
        if(isset($existed_school)){
            Session::flash('message', 'The email already exist');
            Session::flash('flash_type', 'alert-danger');
            return redirect()->back()->withInput();
        }else{
            $school = new School();
            $school->name = $request->name;
            $school->email = $request->email;
            $school->postal_address = $request->postal_address;
            $school->physical_address = $request->physical_address;
            $fileUploads->photoUpload($request, 'logo', $school );
            $school->level = $request->level;
            $school->start_date = Carbon::createFromFormat('d-m-Y', $request->start_date);
            $school->moto = $request->moto;
            $school->admin = $request->admin;
            $school->save();
            //update user's school_id column
            $user = Auth::user();
            $userSchool = School::where('admin', $user->id)->first();
            $user->school_id = $userSchool->id;
            $user->save();

            Session::flash('message', 'School successfully registered.');
            Session::flash('flash_type', 'alert-success');
            return view('dashboard.dashboard', ['user' => Auth::user(), 'school' => $school->where('email', $request->email)->first()]);
        }
    }

    public function school_register(){
        return view('school.registration', ['user' => Auth::user()]);
    }

    public function get_home(User $user, School $school, $id){
        $userSchool = $school->where('admin', Auth::user()->id)->first();
        return view('school.admin', ['school' => $userSchool]);
    }

    public function update(Request $request,School $school,FileUploads $fileUploads, $id){
    // validate input data
        $this->validates($request);

            $school = School::where('id',$id)->first();
            $school->name = $request->name;
            $school->email = $request->email;
            $school->postal_address = $request->postal_address;
            $school->physical_address = $request->physical_address;
            $fileUploads->photoUpload($request, 'logo', $school );
            $school->level = $request->level;
            $school->start_date = Carbon::createFromFormat('Y-m-d', $request->start_date);
            $school->moto = $request->moto;
            $school->admin = $request->admin;
            $school->save();

            Session::flash('message', 'School successfully updated.');
            Session::flash('flash_type', 'alert-success');
            return redirect()->action('SchoolController@get_home', ['school' => $school, 'id' => $school->id]);

    }

    public function validates($request){
        $validator = $this->validate($request, [
            'name' =>'required|string|max:255',
            'email' =>'required|string|email|max:255|unique:users',
            'postal_address' => 'required|string',
            'physical_address' => 'required|string',
            'logo' => 'required|mimes:jpeg,bmp,png,jif,jpg',
            'level' => 'required',
            'start_date' => 'required|string',
            'moto' => 'required'
        ]);
        return $validator;
    }
}
