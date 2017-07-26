<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function create(Request $request){
     if($request->ajax()){
         $data_request = Input::all();
         # run validator
         $this->subjectValidator($data_request);
         $subject = new Subject();
         $subject->name = Input::get('name');
         $subject->code = Input::get('code');
         $subject->grading_choice = Input::get('grading_choice');
         $subject->category = Input::get('category');
         $subject->week_length = Input::get('week_length');
         $subject->save();

         $returnData = ['message' => 'Successfully submited'];

         return response()->json($returnData);
     }

    }

    # subject validator
    private function subjectValidator($data_request){
        return Validator::make($data_request, [
            'name' => 'required|string',
            'code' => 'required|unique',
            'grading_choice' => 'required',
            'category' => 'required',
            'week_length' => 'required|integer'
        ]);
    }
}
