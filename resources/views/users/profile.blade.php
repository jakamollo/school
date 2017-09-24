@extends('layouts.main')

@section('content')
    <div class="content_div">
        <h3 class="user_profile_header">My Profile</h3>
        {{-- Display validation errors --}}
        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                <p class="alert-danger">{{ $error }}</p>
            @endforeach
        @endif
        {{-- Display session message or data --}}
        @if ( Session::has('message') )
            <div id="alert_div" style="width: 350px;height: 35px;border: 1px solid gray;" class="alert-{{ Session::get('flash_type') }}">
                {{ Session::get('message') }}
            </div>
        @endif
        <div class="user_profile_content">
           <div class="user_photo">
             <img style="margin-left: 20px;" class="" src="@if(isset($user->photo)) {{$user->photo }}@else /images/man-face.jpg @endif" height="200px" width="200px">
               <p class="user-profile-name">
                   <span style="color: dodgerblue;">Name</span>:
                   @if($user->gender == 'male')
                       Mr.
                   @elseif($user->gender == 'female')
                       Mrs/Miss.
                   @endif
                    {{ $user->username or '' }}
               </p>
               <p class="user-profile-name"><span style="color: dodgerblue;">Email</span>: {{ $user->email or '' }}</p>
           </div>
        </div>
        <div class="profile_settings">
            {{-- User update modal link --}}
            <a href="#" data-toggle="modal" data-target="#update_user" class="change_user_info_link">
                <div class="link-deco-div">
                    Change User Info
                </div>
            </a>

            {{-- Update user password modal link --}}
            <a href="#" data-toggle="modal" data-target="#change_password" class="change_user_info_link">
                <div class="link-deco-div">
                    Change Password
                </div>
            </a>

            <a href="{{ action('SchoolController@school_register') }}", class="register_school_link">
                <div class="link-deco-div">
                    Register School
                </div>
            </a>

        </div>
        {{-- include modals --}}
        @include('modals.user.edit', ['m' => 'update_user', 'user' => $user, 'modal_height' => 450, 'modal_width' => 700])
        @include('modals.user.update_password', ['m' => 'change_password', 'user' => $user, 'modal_height' => 300, 'modal_width' => 700])
    </div>

@stop