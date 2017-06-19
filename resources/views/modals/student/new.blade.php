@extends('layouts.modal')
@section('modal-title')
Add New Student
@overwrite
@section('body')
    <div class="user-form-open-div">
        {!! Form::open(['route' => ['new_student' ],'method' => 'post', 'id' => 'new_student_form']) !!}
    </div>
    {{ csrf_field() }}
    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
        {{ Form::label('first_name', 'First Name', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('first_name', null, ['class' => 'form-control', 'id' => 'first_name', 'required', 'autofocus']) }}
            @if ($errors->has('first_name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
        {{ Form::label('last_name', 'Last Name', ['class' => 'col-md-4 control-label']) }}
        <div class="col-md-6">
            {{ Form::text('last_name', null, ['class' => 'form-control', 'id' => 'last_name', 'required']) }}
            @if ($errors->has('last_name'))
                <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
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

    <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
        <label for="gender" class="col-md-4 control-label">Level</label>

        <div class="col-md-6">
            <select name="gender" class="form-control" id="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            @if ($errors->has('gender'))
                <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
        <label for="age" class="col-md-4 control-label">Age</label>

        <div class="col-md-6">
            {{ Form::text('age', null, ['class' => 'form-control', 'id' => 'age', 'required']) }}
            @if ($errors->has('age'))
                <span class="help-block">
                                        <strong>{{ $errors->first('age') }}</strong>
                                    </span>
            @endif
        </div>
    </div>
    <input type="text" name="school_id" id="school_id" value="{{ $school->id }}" hidden>

    <div class="form-group{{ $errors->has('form') ? ' has-error' : '' }}">
        <label for="form" class="col-md-4 control-label">Form</label>

        <div class="col-md-6">
            {{ Form::text('form', null, ['class' => 'form-control', 'id' => 'form', 'required']) }}
            @if ($errors->has('form'))
                <span class="help-block">
                                        <strong>{{ $errors->first('form') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('admission_date') ? ' has-error' : '' }}">
        <label for="admission_date" class="col-md-4 control-label">Date of Admission</label>

        <div class="col-md-6">
            {{--<input id="start_date" data-provider="datepicker" type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" required>--}}
            {!! Form::text('admission_date',null, ['class' => 'form-control datepicker', 'id' => 'admission_date', 'required']) !!}
            @if ($errors->has('admission_date'))
                <span class="help-block">
                                        <strong>{{ $errors->first('admission_date') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
    <div class="user-form-close-div">
        {!! Form::close() !!}

    </div>
@stop
