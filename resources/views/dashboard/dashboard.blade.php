@extends('layout.master')

@section('title','Dashboard')

    @section('content')
      
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
            <section class="dashboard-top-sec-wrap">
                <div class="row">
                    <div class="col top-btns">
                        <div class="add-btn">
                            <a href="{{ route('add') }}"  class="btn btn-primary">Add Data</a>
                            
                        </div>

                        <div class="all-posts-btn">
                            <a href="{{ route('posts') }}"  class="btn btn-primary">Go All Posts Data</a>
                            
                        </div>
                    </div>
                </div>
            </section>
            
            <div class="row">
                <h2>A Basic CRUD Table</h2>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allData as $data)
                        <tr>
                        <th scope="row">{{ $data->id }}</th>  
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->mobile }}</td>
                        <td><a href="{{ url('edit/'.$data->id) }}" class="btn btn-success"> Update </a>
                        <a href="{{ url('deleteData/'.$data->id) }}" class="btn btn-danger"> Delete </a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <p>To understand the example better, we have added borders to the table.</p>
            </div>
   @endsection
