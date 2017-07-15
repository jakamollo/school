@extends('layouts.modal')
@section('modal-title')
Update School Info
@overwrite
@section('body')
    <div class="user-form-open-div">
        {!! Form::model($school, ['route' => ['school_update', $school->id ],'method' => 'patch', 'files' => true, 'id' => 'update_school_form']) !!}
    </div>
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        {{ Form::label('name', 'Name', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'required', 'autofocus']) }}
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
            {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'required']) }}
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
            {{ Form::text('postal_address', null, ['class' => 'form-control', 'id' => 'postal_address', 'required']) }}
            @if ($errors->has('postal_address'))
                <span class="help-block">
                                        <strong>{{ $errors->first('postal_address') }}</strong>
                                    </span>
            @endif
        </div>
    </div>
    <input type="text" name="admin" value="{{Auth::user()->id}}" hidden>
    <div class="form-group{{ $errors->has('physical_address') ? ' has-error' : '' }}">
        <label for="physical_address" class="col-md-4 control-label">Physical Address</label>

        <div class="col-md-6">
            {{ Form::text('physical_address', null, ['class' => 'form-control', 'id' => 'physical_address', 'required']) }}
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
            <img src="@if(isset($school->logo)){{ $school->logo }} @else /images/manpic.png @endif" height="100px" width="125px">
            {{ Form::file('logo', null, ['class' => 'logo_input btn btn-primary', 'id' => 'logo', 'required']) }}
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
            {!! Form::select('level', ['national' => 'National','provincial' =>'Provincial','district' => 'District'],$school->logo, ['class' => 'form-control', 'required']) !!}
            @if ($errors->has('level'))
                <span class="help-block">
                                        <strong>{{ $errors->first('level') }}</strong>
                                    </span>
            @endif
        </div>
    </div>
    <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
        <label for="start_date" class="col-md-4 control-label datepicker">Start Date</label>

        <div class="col-md-6">
            {!! Form::text('start_date',null, ['class' => 'form-control', 'id' => 'start_date', 'required']) !!}
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
            {!! Form::text('moto', null, ['class' => 'form-control', 'id' => 'moto', 'required']) !!}
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
                Update
            </button>
        </div>
    </div>
    <div class="user-form-close-div">
        {!! Form::close() !!}

    </div>
@overwrite
