<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\FileUploads;

class PostController extends Controller
{
    public function post(Request $request, FileUploads $fileUploads){
        if($request->ajax()){
          // run validator
            $inputData = Input::all();
            $file_data = Input::get('attachment');
            $user_id = Input::get('school_id');
            $this->validatePost($inputData);
            $post = new Post();
            $post->body = Input::get('body');
            $post->user_id = Input::get('user_id');
            if(isset($file_data)){
                $post->attachment = $file_data;
            }
            $post->school_id = $user_id;
            $post->save();
            $user= User::where('id',$user_id)->first();
            $returnData = [
                'username' => $user->username,
                'photo' => $user->photo,
            ];
            return response()->json($returnData);
        }
    }

    public function validatePost($inputData){
        return Validator::make($inputData, [
            'body' =>'required|string',
            'attachment' => 'mimes:pdf,doc,docx,potx,ppsx','ppt','pptx','txt',
        ]);

    }

    public function delete($id, Request $request){
        if($request->ajax()){
            return response()->json(Input::all());
            Post::find($id)->delete();




























        }
    }


}
