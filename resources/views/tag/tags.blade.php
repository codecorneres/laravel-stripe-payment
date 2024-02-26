@extends('layout.master')

@section('title','Tags')

    @section('content')
    <div class="row dashboard-top-sec-wrap">
        <div class="col top-btns">
            <div class="add-btn">
                <a href="{{ route('dashboard') }}"  class="btn btn-primary">Back To Dashboard</a>
            </div>
            <div class="add-btn">
                <a href="{{ route('tags.create') }}"  class="btn btn-primary">New Tag</a>
            </div>
        </div>
    </div>
    <section class="tags-wrap">
        <div class="table-row">
            <h2>All Tags (One To One)</h2>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tag</th>
                    <th scope="col">User</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach ($tags as $tag)
                    <tr>
                    <th scope="row">{{ $tag->id }}</th>  
                    <td>{{ $tag->tag }}</td>
                    <td>{{ $tag->user->name }} ({{ $tag->user_id }})</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endsection