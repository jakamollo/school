@extends('layouts.modal')
@section('modal-title')
Update User Info
@overwrite
@section('body')
    <div class="user-form-open-div">
        {!! Form::model($user, ['route' => ['user_update', $user->id ],'method' => 'patch', 'files' => true, 'id' => 'update_user_form']) !!}
    </div>
    <div class="user-name-div">
        {{ csrf_field() }}
        @if($errors->has('username'))
            <div class="alert-danger">{{ $errors->first('username') }}</div>
        @endif

        {{ Form::label('username', 'Name:', ['class' => 'name_label']) }}
        {{ Form::text('username', null, ['class' => 'name_input', 'id' => 'name_input' ]) }}<br>
    </div>
    <div class="user-email-div">
        @if($errors->has('email'))
            <div class="alert-danger">{{ $errors->first('email') }}</div>
        @endif

        {{ Form::label('email', 'Email Address:', ['class' => 'email_label']) }}
        {{ Form::text('email',null, ['class' => 'email_input', 'id' => 'email_input']) }}<br>
    </div>

    <div class="user-photo-div">
        @if($errors->has('photo'))
            @foreach($errors->get('photo') as $message)
                <div class="alert-danger">
                    {{ $message }}
                </div>
            @endforeach
        @endif

        {{ Form::label('photo', 'Photo:', ['class' => 'photo_label']) }}
        <div class="photo_input_div">
            <img class="sign-up-image" src="@if(isset($user->photo)){{ $user->photo }} @else images/manpic.png @endif" height="100px" width="125px">
            {{ Form::file('photo', null, ['class' => 'photo_input', 'id' => 'photo_input']) }}<br>
        </div>
    </div>
    {{ Form::text('user_id', $user->id , ['class' => 'type_input', 'id' => 'user_id_input', 'hidden' => true]) }}
    <div class="user-gender-div">
        @if($errors->has('gender'))
            <div class="alert-danger">{{ $errors->first('gender') }}</div>
        @endif

        {{ Form::label('gender', 'Gender:', ['class' => 'update_user_gender_label']) }}
        {{ Form::label('male', 'Male:', ['class' => 'male_label']) }}
        {{ Form::radio('gender', 'male',true, ['class' => 'male_input']) }}
        {{ Form::label('female', 'Female:', ['class' => 'female_label']) }}
        {{ Form::radio('gender', 'female',false, ['class' => 'male_input']) }}<br>
    </div>
    <div class="user-submit-div">
        {{ Form::submit('Submit', ['class' => 'login_btn btn btn-primary', 'id' => 'user-update-submit-btn']) }}


    </div>
    <div class="user-form-close-div">
        {!! Form::close() !!}

    </div>
@stop
