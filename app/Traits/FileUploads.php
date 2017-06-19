<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 6/14/2017
 * Time: 8:58 PM
 */

namespace App\Traits;


class FileUploads
{
    public function photoUpload($request, $inputName, $modelName){
        $request->file($inputName)->move(public_path('images'), $request->file($inputName)->getClientOriginalName());
        $modelName->$inputName = '/'.'images'.'/'.$request->file($inputName)->getClientOriginalName();
    }
}