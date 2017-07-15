<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Online School System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tether/css/tether.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/tether/css/tether.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('jquery-ui-themes/themes/smoothness/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('jquery-ui/jquery-ui.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}



    <!-- Styles -->

</head>
<body style="overflow-y: scroll;">
@yield('school')
</body>

<script type="text/javascript" src="{{ asset('/js/jquery.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/tether/js/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap/js/bootstrap.js') }}"></script>
<script type="text/javascript" src="{{ asset('/js/bootstrap/js/bootstrap.min.js') }}"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('/js/global.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('jquery-ui/external/jquery/jquery.js') }}"></script>--}}
<script type="text/javascript" src="{{ asset('jquery-ui/jquery-ui.js') }}"></script>


</html>
