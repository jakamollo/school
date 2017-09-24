@extends('layouts.main')
@section('content')
    <div class="content_div">
        @if ( Session::has('message') )
            <div id="alert_div" class="alert {{ Session::get('flash_type') }}">
                <p class="alert-para">{{ Session::get('message') }}</p>
            </div>
        @endif
     {{-- js success message --}}
            <div class="success_message" id="success_message">
              {{-- append the message here --}}
            </div>
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
            <a href="#new_subject" data-toggle="modal" >
                <div class="link-deco-div">
                    Add Subject
                </div>
            </a>

            @include('modals.student.new', ['m' => 'new_student', 'school' => $school, 'modal_height' => 750, 'modal_width' => 700])
            @include('modals.school.edit', ['m' => 'edit_school', 'school' => $school, 'modal_height' => 890, 'modal_width' => 800])
            @include('modals.staff.new', ['m' => 'new_staff', 'school' => $school, 'modal_height' => 950, 'modal_width' => 700])
            @include('modals.subject.new', ['m' => 'new_subject', 'modal_height' => 450, 'modal_width' => 700])

        </div>
            <div class="navigation-tabs">
                <ul class="nav nav-tabs">
                    <li class="student-list active"><a href="#students_list" data-toggle="tab">List Students</a></li>
                    <li class="staff-list"><a href="#staff_list" data-toggle="tab">List Staff</a></li>
                </ul>
            </div>
        <div class="tabs-display-area">
            <div class="tab-content clearfix">
                <div id="students_list" class="tab-pane active">
                    @include('school.students', ['school' => $school])
                </div>
                <div id="staff_list" class="tab-pane fade">
                    @include('school.list_staff')
                </div>
            </div>

        </div>
    </div>

@endsection

