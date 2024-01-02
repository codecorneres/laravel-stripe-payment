@extends('layout.master')
@section('title') {{'ADD POST'}} @endsection
@section('content')
        <div class="row">
            <h1>Insert New Post</h1>
            <form method="post" action="{{ route('addedPost') }}">
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="name">Title</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name">
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <div class="col-md-12 form-group">
                            <textarea id="content" name="content" class="form-control" rows="15" cols="127"></textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
 @endsection