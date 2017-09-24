@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                {{-- Display validation errors --}}
                @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <p class="alert-danger">{{ $error }}</p>
                    @endforeach
                @endif
                @if ( Session::has('message') )
                    <div id="alert_div" class="alert-{{ Session::get('flash_type') }}">
                        <p class="alert-para">{{ Session::get('message') }}</p>
                    </div>
                @endif
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('post_signup') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">User Name</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <input name="type" type="text" value="admin" hidden>
                        <input name="confirmed" type="text" value="no" hidden>
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="photo" class="col-md-4 control-label">Photo</label>
                            <div class="col-md-6 photo_input_div">
                              <img src="/images/manpic.png" height="100px" width="125px">
                                <input type="file" name="photo" class="photo_input btn btn-primary" required>
                            </div>
                            @if($errors->has('photo'))
                                @foreach($errors->get('photo') as $message)
                                    <div class="alert-danger">
                                        {{ $message }}
                                    </div>
                                @endforeach
                            @endif
                            </div>
                        <div class="form-group{{ $errors->has('photo') ? ' has-error' : '' }}">
                            <label for="gender" class="gender_label">Gender</label>
                            <label for="male" class="male_label">Male</label>
                            <input type="radio" name="gender" value="male" checked class="male_input">
                            <label for="female" class="female_label">Female</label>
                            <input type="radio" name="gender" value="female" class="female_input">

                            @if($errors->has('gender'))
                                <div class="alert-danger">{{ $errors->first('gender') }}</div>
                            @endif
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
