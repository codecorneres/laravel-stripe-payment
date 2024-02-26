@extends('layout.master')
@section('title') {{'New Tag'}} @endsection
@section('content')
        <div class="row">
            <h1>New Tag</h1>
            <form method="post" action="{{ url('/createTag') }}" >
                @csrf
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="tag">Tag</label>
                        <input type="text" name="tag" class="form-control" id="tag" placeholder="Enter Tag Name">
                    </div>
                    
                    <div class="col-md-12 form-group">
                        <label for="users">Choose User:</label>
                        <select name="user" id="user">
                            <option value="volvo">Volvo</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Submit</button>
            </form>
        </div>
 @endsection