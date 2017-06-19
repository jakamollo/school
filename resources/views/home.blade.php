@extends('layouts.app')

@section('content')
<div class="container">
    @if ( Session::has('message') )

        <div id="alert_div" class="alert {{ Session::get('flash_type') }}">
            <p class="alert-para">{{ Session::get('message') }}</p>
        </div>

    @endif
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
