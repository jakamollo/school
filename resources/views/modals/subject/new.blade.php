<div class="modal fade modal-lg subject_modal" id="{{ $m }}" data-backdrop="false" data-keyboard="true" role="dialog">
{{-- modal content--}}
    <div class="modal_content">
        {{-- modal header--}}
    <div class="modal_header">
        <h4 class="modal_header_title">Add Subject</h4>
        <button class="btn btn-sm subject-dismiss-btn" type="button" data-dismiss="modal">&times;</button>
    </div>
        {{-- modal body--}}
        <div class="modal_body">
            <div class="subj_modal_form_open">
               {!! Form::open(['route' => 'new_subject', 'method' => 'POST']) !!}
            </div>
            {{ csrf_field() }}
            {{-- name div--}}
            <div class="subj_form_group">
                <label for="name">Subject Name</label>
                <div>
                    {!! Form::text('name',null, ['class' => '', 'id' => 'new_subj_name', 'required']) !!}
                </div>
            </div>
            {{-- code div--}}
            <div class="subj_form_group">
                <label for="code">Subject Code</label>
                <div>
                    {!! Form::text('code',null, ['class' => '', 'id' => 'new_subj_code', 'required']) !!}
                </div>
                    @if($errors->has('code'))
                        <div class="alert alert-danger">{{ $errors->first('code') }}</div>
                    @endif
            </div>
            {{-- grading div--}}
            <div class="subj_form_group">
                <label for="grading_choice">Grading Choice</label>
                <div>
                    {!! Form::select('grading_choice', ['a' => 'A','b' => 'B','c' =>'C'],null,['class' => '', 'id' => 'new_subj_grading', 'required']) !!}
                </div>
            </div>
            {{-- category div--}}
            <div class="subj_form_group">
                <label for="category">Subject Category</label>
                <div>
                    {!! Form::select('category', ['mandatory' => 'Mandatory', 'sciences' => 'Sciences', 'humanities' => 'Humanities', 'applied' => 'Applied'],null,['class' => '','id' => 'new_subj_category', 'required']) !!}
                </div>
            </div>
            {{-- Length in weeks div --}}
            <div class="subj_form_group">
              <label for="week_length">Length in Weeks</label>
                <div>
                    {!! Form::text('week_length',null, ['class' => '', 'id' => 'new_subj_week_length', 'required']) !!}
                </div>
                <div class="" id="new-subj-week-length-error">
                    {{-- append error div here --}}
                </div>
            </div>

        </div>
        {{-- modal footer--}}
        <div class="modal_footer">
            {{-- submit button --}}
            <div class="subj_submit_btn">
                <button type="submit" class="btn btn-primary submit_subj" id="new-subj-submit-btn">Submit</button>
            </div>
            {{-- close button --}}
            <div class="subj_close_button">
               <button type="button" class="btn btn-danger close_subj_modal">Close</button>
            </div>
        </div>
        <div class="subj_form_close">
            {!! Form::close() !!}
        </div>
</div>
</div>