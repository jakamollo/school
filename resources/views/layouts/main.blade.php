@extends('layouts.parent')

@section('school')
    {{-- include the shared navigation blade--}}
    @include('shared.nav')
    @yield('content')
    {{-- include footer blade --}}
    @include('shared.footer')
@stop
