<div class="modal fade modal-wrapper" id="{{ $m }}" data-backdrop="false">

    <button type="button" class="close op10" data-dismiss="modal">
        <span class="crff " aria-hidden="true">&times;</span>
    </button>
    <div class="modal_title"><span class="span-modal-title">@yield('modal-title', 'Modal Title')</span></div>
    {{-- add modal body here--}}
    @yield('body')
</div>