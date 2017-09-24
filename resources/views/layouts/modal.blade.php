<div class="modal fade modal-wrapper" id="{{ $m }}" style="height: {{$modal_height}}px; width: {{$modal_width}}px;" data-backdrop="false">

    {{--<button type="button" value="{{ $m }}" class="close op10 close_modal" id="close_modal{{ $m }}">--}}
        {{--<span class="crff " aria-hidden="true">&times;</span>--}}
    {{--</button>--}}
    <div class="modal_content">
        <div class="modal_header">
            <h4 style="margin-left: 10px;">@yield('modal-title', 'Modal Title')</h4>
            <button value="{{$m}}" id="close_modal{{$m}}" class="btn btn-sm edit-user-dismiss-btn" type="button" data-dismiss="modal">&times;</button>
        </div>
        {{--<div class="modal_title"><span class="span-modal-title">@yield('modal-title', 'Modal Title')</span></div>--}}
        {{-- add modal body here--}}
        @yield('body')
    </div>

</div>