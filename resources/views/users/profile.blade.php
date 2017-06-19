@extends('layouts.main')

@section('content')
    <div class="content_div">
        <h3 class="user_profile_header">My Profile</h3>
        @if ( Session::has('message') )

            <div id="alert_div" class="alert {{ Session::get('flash_type') }}">
                <p class="alert-para">{{ Session::get('message') }}</p>
            </div>

        @endif
        <div class="user_profile_content">
           <div class="user_photo">
             <img class="image-circle" src="@if(isset($user->photo)) {{$user->photo }}@else /images/man-face.jpg @endif" height="200px" width="200px">
               <p class="user-profile-name">
                   Name:
                   @if($user->gender == 'male')
                   Mr.
                   @elseif($user->gender == 'female')
                       Mrs/Miss.
                   @endif
                    {{ $user->username or '' }}
               </p>
               <p class="user-profile-name">Email: {{ $user->email or '' }}</p>
           </div>
        </div>
        <div class="profile_settings">
            <a href="#" data-toggle="modal" data-target="#update_user" class="change_user_info_link">
                <div class="link-deco-div">
                    Change User Info
                </div>
            </a>

            <a href="{{ action('SchoolController@school_register') }}", class="register_school_link">
                <div class="link-deco-div">
                    Register School
                </div>
            </a>

        </div>
        {{-- include profile modal --}}
        @include('modals.user.edit', ['m' => 'update_user', 'user' => $user])
    </div>

@stop