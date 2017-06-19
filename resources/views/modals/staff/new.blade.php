@extends('layouts.modal')
@section('modal-title')
Add New Staff
@overwrite
@section('body')
    <div class="user-form-open-div">
        {!! Form::open(['route' => ['new_staff' ],'method' => 'post', 'id' => 'new_staff_form']) !!}
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

    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
        <label for="type" class="col-md-4 control-label">Type of Employee</label>

        <div class="col-md-6">
            <select name="type" class="form-control" id="employee_type" required>
                <option value="teacher">Teacher</option>
                <option value="cook">Cook</option>
                <option value="librarian">Librarian</option>
                <option value="accountant">Accountant</option>
                <option value="secretary">Secretary</option>
                <option value="lab_tech">Lab Technician</option>
                <option value="Others">Others</option>
            </select>
            {{ Form::text('other_type', null, ['class' => 'form-control', 'id' => 'other_type', 'placeholder' => 'Add your option here']) }}
            @if ($errors->has('type'))
                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('management_level') ? ' has-error' : '' }}">
        <label for="management_level" class="col-md-4 control-label">Management Level</label>

        <div class="col-md-6">
            <select name="management_level" class="form-control" id="management_level" required>
                <option value="principal">Principal</option>
                <option value="deputy principal">Deputy Principal</option>
                <option value="senior teacher">Sinior Teacher</option>
                <option value="class teacher">Class Teacher</option>
                <option value="hod">HOD</option>
                <option value="Others">Others</option>
            </select>
            {{--<div id="management-level-other-div" hidden>--}}
            {{ Form::text('other', null, ['class' => 'form-control management-level-other', 'id' => 'other', 'placeholder' => 'Add your option here']) }}
            {{--</div>--}}
            @if ($errors->has('type'))
                <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('joining_date') ? ' has-error' : '' }}">
        <label for="joining_date" class="col-md-4 control-label">Date of Joining</label>

        <div class="col-md-6">
            {{--<input id="start_date" data-provider="datepicker" type="text" class="form-control" name="start_date" value="{{ old('start_date') }}" required>--}}
            {!! Form::text('joining_date',null, ['class' => 'form-control datepicker', 'id' => 'joining_date', 'required']) !!}
            @if ($errors->has('joining_date'))
                <span class="help-block">
                                        <strong>{{ $errors->first('joining_date') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('professional_qualifications') ? ' has-error' : '' }}">
        <label for="professional_qualifications" class="col-md-4 control-label">Professional Qualifications</label>

        <div class="col-md-6">
            <textarea name="professional_qualifications" type="tex" class="form-control"></textarea>
            @if ($errors->has('professional_qualifications'))
                <span class="help-block">
                                        <strong>{{ $errors->first('professional_qualifications') }}</strong>
                                    </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary" id="submit-new-staff">
                Submit
            </button>
        </div>
    </div>
    <div class="user-form-close-div">
        {!! Form::close() !!}

    </div>
@stop
