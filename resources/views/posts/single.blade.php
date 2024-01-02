@extends('layout.master')
@section('title') {{'Single Post'}} @endsection
    @section('content')
        <section class="dashboard-top-sec-wrap">
            <div class="row">
                <div class="col top-btns">
                    {{-- <div class="btn-edit">
                        <a href="{{ url('edit-post/'.$post->id) }}"  class="btn btn-primary">Edit Post</a> 
                    </div> --}}
                    <div class="btn-back">
                        <a href="{{ route('posts') }}"  class="btn btn-primary">Back to All Posts</a> 
                    </div>
                </div>
            </div>
        </section>
        <section class="single-post-wrap">
            <div class="row">
                <form method="post" action="{{ route('edit-post',$post->id) }}" >
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-12 form-group mt-10">
                            {{-- <label for="name">Post Name</label> --}}
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Post Name" value="{{ $post->name }}">
                        </div>
                        <div class="col-md-12 form-group mt-10">
                            <textarea id="content" name="content" class="form-control" rows="15" cols="127">{{ $post->content }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Post Update</button>
                </form>
            </div>
        </section>

        @if(session('status'))
            <div class="alert alert-warning mb-1 mt-1">
                {{ session('status') }}
            </div>
        @endif
        
        <section class="comment-area-wrapper mt-5 mb-5">
            <div class="card card-body">
                <h4 class="card-title">
                    Leave a comment
                </h4>
                <form action="{{ url('comments') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="comment_body" class="form-control" id="comment_body" cols="30" rows="10"></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
            @forelse ($post->comments as $comment)
                <div class="card card-body shadow-sm mt-3">
                    <div class="detail-area">
                        @if($comment->user)
                            <h4 class="user-name mb-1">{{ $comment->user->name }}</h4>
                        @endif
                        <small class="ms-3 text-primary">Commented on: {{ $comment->created_at }}</small>
                        <p class="user-comment mb-1">{{ $comment->comment_body }}</p>
                    </div>
                </div>
            @empty
                <div class="mt-3">
                    <h6>No Comments Yet.</h6>
                </div>
            @endforelse
        </section>

    @endsection
