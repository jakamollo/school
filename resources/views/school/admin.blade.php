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
        <h3 class="school_home_heading">Welcome to @if(isset($school->name)) {{ $school->name }} @else School @endif </h3>
        <div class="school_nav_menus">
            <a href="#" data-toggle="modal" data-target="#edit_school" >
                <div class="link-deco-div">
                    Update School Info
                </div>
            </a>

            <a href="{{ action('UserController@get_dashboard') }}">
               <div class="link-deco-div">
                   Add Admin
               </div>
            </a>

            <a href="#" data-toggle="modal" data-target="#new_staff" >
                <div class="link-deco-div">
                    Add Staff
                </div>
            </a>
            <a href="#" data-toggle="modal" data-target="#new_student" >
                <div class="link-deco-div">
                    Add Student
                </div>
            </a>

            @include('modals.student.new', ['m' => 'new_student', 'school' => $school])
            @include('modals.school.edit', ['m' => 'edit_school', 'school' => $school])
            @include('modals.staff.new', ['m' => 'new_staff', 'school' => $school])

        </div>
    </div>

@endsection

