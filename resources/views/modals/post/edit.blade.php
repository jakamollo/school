@extends('layouts.modal')
@section('modal-title')
    Edit Post
@overwrite`
@section('body')
{!! Form::model($post, ['route' => ['update_post', $post->id],'id' => 'edit_post_form'.$post->id, 'method' => 'PATCH', 'files' => true]) !!}
{{ csrf_field() }}
{!! Form::textarea('body',null, ['id' => 'edit_post_content'.$post->id, 'class' => 'edit_post_content']) !!}
@if($errors->has('body'))
    <div class="alert-danger">{{ $errors->first('body') }}</div>
@endif
<input type="text" name="user_id" value="{{ Auth::user()->id }}" id="post-owner{{ $post->id }}" class="post-owner" hidden="true">
<input type="text" name="post_id" value="{{ $post->id }}" id="edit_post_id{{ $post->id }}" class="edit_post_id" hidden>
<button type="submit" class="btn btn-primary edit-post-btn" id="btn{{ $post->id }}" value="{{ $post->id }}">
    Submit Changes
</button>
<input type="file" name="attachment" id="post-attachment{{ $post->id }}" class="post-attachment">
<input type="text" name="school_id" value="{{ $user->school->id }}" id="post-school-id{{ $post->id }}" class="post-school-id" hidden="true">
@if($errors->has('attachment'))
    <div class="alert-danger">{{ $errors->first('attachment') }}</div>
@endif
{!! Form::close() !!}
@overwrite