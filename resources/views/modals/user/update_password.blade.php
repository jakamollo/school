@extends('layouts.modal')
@section('modal-title')
    Change Password
@overwrite
@section('body')
   {!! Form::open(['route' => ['change_password', 'id' => $user->id],'method' => 'patch']) !!}
   {{-- old password --}}
   {{--<div class="old-password-div" style="margin-left: 10px;margin-top: 10px;margin-bottom: 5px;">--}}
       {{--@if($errors->has('old_password'))--}}
           {{--<div class="alert-danger">{{ $errors->first('old_password') }}</div>--}}
       {{--@endif--}}

       {{--{{ Form::label('old_password', 'Old Password:', ['class' => 'old_password_label','style'=>'padding-right:45px;font-weight:bold;']) }}--}}
       {{--{{ Form::password('old_password',null, ['class' => 'old_password_input', 'id' => 'old_password_input','required']) }}<br>--}}
   {{--</div>--}}
   {{-- new password --}}
   <div class="new-password-div" style="margin-left: 10px;margin-top: 10px;margin-bottom: 5px;">
       @if($errors->has('new_password'))
           <div class="alert-danger">{{ $errors->first('new_password') }}</div>
       @endif

       {{ Form::label('new_password', 'New Password:', ['class' => 'new_password_label','style'=>'padding-right:40px;font-weight:bold;']) }}
       {{ Form::password('new_password',null, ['class' => 'new_password_input', 'id' => 'new_password_input','required']) }}<br>
   </div>
   {{-- password confirmation --}}
   <div class="password-confirmation-div" style="margin-left: 10px;margin-top: 10px;margin-bottom: 5px;">
       @if($errors->has('password_confirmation'))
           <div class="alert-danger">{{ $errors->first('password_confirmation') }}</div>
       @endif

       {{ Form::label('password_confirmation', 'Confirm Password:', ['class' => 'password_confirmation_label','style'=>'padding-right:15px;font-weight:bold;']) }}
       {{ Form::password('password_confirmation',null, ['class' => 'password_confirmation_input', 'id' => 'password_confirmation','required']) }}<br>
   </div>
   {{-- Submit button --}}
   {!! Form::submit('Submit', ['style'=>'margin-top:15px;margin-left:170px;', 'class' => 'btn btn-primary chng-pswd-submit-btn']) !!}

    {!! Form::close() !!}
@overwrite