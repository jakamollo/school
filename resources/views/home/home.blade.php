@extends('layouts.main')
@section('content')
<div class="content_div">
    <h3 class="home-header">Welcome Home</h3>
    <div class="home-left-panel">
        <h4>Left Panel</h4>
    </div>
    <div class="home-post-div">
        {{--@if ( Session::has('message') )--}}

            {{--<div id="alert_div" class="alert {{ Session::get('flash_type') }}">--}}
                {{--<p class="alert-para">{{ Session::get('message') }}</p>--}}
            {{--</div>--}}

        {{--@endif--}}
        <form class="form-horizontal" id="post-form" role="form" method="POST" action="{{ route('post_post') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <textarea type="text" name="body" id="post_content" class="home-post-textarea" placeholder="What's on your mind?"></textarea>
            @if($errors->has('body'))
                <div class="alert-danger">{{ $errors->first('body') }}</div>
            @endif
            <input type="text" name="user_id" value="{{ Auth::user()->id }}" id="post_owner" hidden="true">
        <button type="submit" class="btn btn-primary post-btn">
            Post
        </button>
            <input type="file" name="attachment" id="post_attachment" class="">
            <input type="text" name="school_id" value="{{ $user->school->id }}" id="post_school_id" hidden="true">
            @if($errors->has('attachment'))
                <div class="alert-danger">{{ $errors->first('attachment') }}</div>
            @endif
        </form>
    </div>
    <div class="post-display-div">
        @if(isset($posts))
            @forelse($posts as $post)
    <div class="post-content" id="post{{ $post->id }}">
        <div class="user_photo" id="user_photo{{ $post->id }}"><img id="user_image{{ $post->id }}" src="{{ \App\User::where('id', $post->user_id)->first()['photo'] }}" height="50px" width="50px">
             <p class="post_user_name" id="post_user_name{{ $post->id }}">{{ \App\User::where('id', $post->user_id)->first()['username'] }}</p>
            <p class="post-body" id="post-body{{ $post->id }}">
                {{ $post->body }}
            </p>
            <button type="button" data-toggle="modal" data-target="#{{ $post->id }}" class="btn edit-post">Edit</button>

                {!! Form::open(['route' => ['delete_post', 'id' => $post->id ],'method' => 'DELETE', 'id' => 'delete-post-form']) !!}
                {{ csrf_field() }}
                <input type="text" name="id" value="{{ $post->id }}" id="delete_post_id" hidden="true">
            <button type="submit" class="btn btn-danger delete-post" value="{{ $post->id }}" >Delete</button>

                {!! Form::close() !!}
        </div>
        @include('modals.post.edit', ['m' => $post->id, 'post' => $post, 'modal_height' => 290, 'modal_width' => 600])
    </div>

            @empty
                <div class="alert-no-post">
                    No posts found
                </div>
            @endforelse
            @else
        <div class="alert-danger">
            No posts found
        </div>
        @endif
            <div class="home_posts_pagination">{{ $posts->links() }}</div>
    </div>
    <div class="home-right-panel">
        <h4>Right Panel</h4>
    </div>
</div>
@stop