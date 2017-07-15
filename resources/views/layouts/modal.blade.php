<div class="modal fade modal-wrapper" id="{{ $m }}" data-backdrop="false">

    <button type="button" value="{{ $m }}" class="close op10 close_modal" id="close_modal{{ $m }}">
        <span class="crff " aria-hidden="true">&times;</span>
    </button>
    <div class="modal_title"><span class="span-modal-title">@yield('modal-title', 'Modal Title')</span></div>
    {{-- add modal body here--}}
    @yield('body')
</div>