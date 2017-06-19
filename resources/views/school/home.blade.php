@extends('layouts.main')
@section('content')
<div class="content_div">
    <h3 class="school_home_heading">Welcome to @if(isset($school->name)) {{ $school->name }} @else School @endif </h3>
    <div class="school_nav_menus">
        <a href="#" data-toggle="modal" data-target="#profile_modal" class="link_deco">Update School Info</a><br>

        <a href="{{ action('UserController@get_dashboard') }}", class="link_deco"></a><br>

        <a href="{{ action('SchoolController@school_register') }}", class="link_deco">Register School</a>

    </div>
</div>
@stop