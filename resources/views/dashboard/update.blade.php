@extends('layout.master')
@section('title') {{'Update DATA'}} @endsection
    @section('content')
        <div class="row">
            <h1>Update Table Data</h1>
            
            <form method="post" action="{{ route('update',$data->id) }}" >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ $data->name }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" value="{{ $data->email }}" aria-describedby="emailHelp" placeholder="Enter email">
                        <small id="email" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="col-md-4 form-group">
                        <label class="" for="mobile">Mobile</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $data->mobile }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
    @endsection
