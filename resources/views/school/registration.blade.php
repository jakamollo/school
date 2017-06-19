@extends('layouts.main')
@section('content')
    <div class="reg_sch_cont_div col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading reg_sch_heading">Register Your School</div>
            @if ( Session::has('message') )

                <div id="alert_div" class="alert {{ Session::get('flash_type') }}">
                    <p class="alert-para">{{ Session::get('message') }}</p>
                </div>

            @endif
            <div class="panel-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('register_school') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
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
                    <div class="form-group{{ $errors->has('postal_address') ? ' has-error' : '' }}">
                        <label for="postal_address" class="col-md-4 control-label">Postal Address</label>

                        <div class="col-md-6">
                            <input id="postal_address" type="text" class="form-control" name="postal_address" value="{{ old('postal_address') }}" required>

                            @if ($errors->has('postal_address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('postal_address') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <input type="text" name="admin" value="{{$user->id}}" hidden>
                    <div class="form-group{{ $errors->has('physical_address') ? ' has-error' : '' }}">
                        <label for="physical_address" class="col-md-4 control-label">Physical Address</label>

                        <div class="col-md-6">
                            <input id="physical_address" type="text" class="form-control" name="physical_address" value="{{ old('physical_address') }}" required>

                            @if ($errors->has('physical_address'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('physical_address') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                        <label for="logo" class="col-md-4 control-label">Logo</label>
                        <div class="col-md-6 photo_input_div">
                            <img src="/images/manpic.png" height="100px" width="125px">
                            <input type="file" name="logo" class="logo_input btn btn-primary" required>
                        </div>
                        @if($errors->has('logo'))
                            @foreach($errors->get('logo') as $message)
                                <div class="alert-danger">
                                    {{ $message }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                        <label for="level" class="col-md-4 control-label">Level</label>

                        <div class="col-md-6">
                            <select name="level" class="form-control" required>
                                <option value="national">National</option>
                                <option value="provincial">Provincial</option>
                                <option value="district">District</option>
                            </select>
                            @if ($errors->has('level'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                        <label for="start_date" class="col-md-4 control-label">Start Date</label>

                        <div class="col-md-6">
                            <input id="start_date" data-provider="datepicker" type="text" class="form-control datepicker" name="start_date" value="{{ old('start_date') }}" required>

                            @if ($errors->has('start_date'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('moto') ? ' has-error' : '' }}">
                        <label for="moto" class="col-md-4 control-label">School Motto</label>

                        <div class="col-md-6">
                            <input id="moto" type="text" class="form-control" name="moto" value="{{ old('moto') }}" required>

                            @if ($errors->has('moto'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('moto') }}</strong>
                                    </span>
                            @endif
                        </div>
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
@stop