@extends('layouts.main')

@section('content')
    <div class="content_div">
        @if ( Session::has('message') )

            <div id="alert_div" class="alert {{ Session::get('flash_type') }}">
                <p class="alert-para">{{ Session::get('message') }}</p>
            </div>

        @endif
            <div class="dshbrd_school_logo_div">
                <img src="@if(isset($school->logo)) {{ $school->logo }}  @else /images/school3.png @endif" height="50px" width="50px" class="dshbrd_school_logo">
            </div>
        <h3 class="dashboard_heading">Welcome to @if(isset($school->name)) {{ $school->name }} @else School @endif Dashboard</h3>

        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Register School</a>
        </div>
        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Staff</a>
        </div>
        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Students</a>
        </div>
        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Exam</a>
        </div>
        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Reports</a>
        </div>
        <div class="dashboard_menus">
            <a class="dashboard_link" href="">Classroom</a>
        </div>
    </div>
@stop                                                                                                                                                                                     