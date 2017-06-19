@extends('layouts.parent')
@section('school')
    <div class="login-div">
        <h3 class="login-heading">Sign Up</h3>
        @if ( Session::has('message') )

            <div class="alert {{ Session::get('flash_type') }}">
                <h4>{{ Session::get('message') }}</h4>
            </div>

        @endif
        {!! Form::open(['route' => 'sign_up', 'method' => 'post', 'files' => true]) !!}
        {{ csrf_field() }}
        @if($errors->has('name'))
            <div class="alert-danger">{{ $errors->first('name') }}</div>
        @endif

        {{ Form::label('name', 'Name:', ['class' => 'name_label']) }}
        {{ Form::text('name', null, ['class' => 'name_input']) }}<br>
        @if($errors->has('email'))
            <div class="alert-danger">{{ $errors->first('email') }}</div>
        @endif

        {{ Form::label('email', 'Email Address:', ['class' => 'email_label']) }}
        {{ Form::text('email',null, ['class' => 'email_input']) }}<br>
        @if($errors->has('password'))
            <div class="alert-danger">{{ $errors->first('password') }}</div>
        @endif

        {{ Form::label('password', 'Password:', ['class' => 'password_label']) }}
        {{ Form::password('password', null, ['class' => 'password_input']) }}<br>
        @if($errors->has('photo'))
            @foreach($errors->get('photo') as $message)
                <div class="alert-danger">
                    {{ $message }}
                </div>
            @endforeach
        @endif

        {{ Form::label('photo', 'Photo:', ['class' => 'photo_label']) }}
        <div class="photo_input_div">
            <img src="images/manpic.png" height="100px" width="125px">
            {{ Form::file('photo', null, ['class' => 'photo_input']) }}<br>
        </div>
        {{ Form::text('type', 'admin', ['class' => 'type_input', 'hidden' => true]) }}
        @if($errors->has('gender'))
            <div class="alert-danger">{{ $errors->first('gender') }}</div>
        @endif

        {{ Form::label('gender', 'Gender:', ['class' => 'gender_label']) }}
        {{ Form::label('male', 'Male:', ['class' => 'male_label']) }}
        {{ Form::radio('gender', 'Male',true, ['class' => 'male_input']) }}
        {{ Form::label('female', 'Female:', ['class' => 'female_label']) }}
        {{ Form::radio('gender', 'Female',false, ['class' => 'female_input']) }}<br>
        {{ Form::submit('Login', ['class' => 'login_btn btn btn-primary']) }}
        {!! Form::close() !!}
        <div class="do-you-have-account">
            <p><a class="sign_up_url" href="{{ action('UserController@get_login') }}">Go back to the login page</a></p>
        </div>
    </div>
@stop