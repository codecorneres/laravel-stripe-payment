@extends('layout.master')

@section('title','Posts')

    @section('content')
      
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
            <div class="row dashboard-top-sec-wrap">
                <div class="col top-btns">
                    <div class="add-btn">
                        <a href="{{ route('dashboard') }}"  class="btn btn-primary">Back To Dashboard</a>
                    </div>
                    <div class="add-btn">
                        <a href="{{ route('add_post') }}"  class="btn btn-primary">Add New Post</a>
                    </div>
                </div>
            </div>
           
            <section class="all-posts-wrap">
                <div class="">
                    <!-- Buttons to choose list or grid view -->
                    <button onclick="listView()" class="btn btn-success"><i class="fa fa-bars"></i> List</button>
                    <button onclick="gridView()" class="btn btn-success"><i class="fa fa-th-large"></i> Grid</button>
                    <h1>All Posts</h1>
                   
                    <div class="row">
                        @if($allPostsData)
                            @foreach ($allPostsData as $post)
                                <div class="column">
                                    <a href="{{ url('single/'.$post->id) }}">
                                        <div class="content"> 
                                            <h2>{{ $post->name }}</h2>
                                            <p>{{ $post->content }}</p>
                                            
                                          
                                            @if( $post->file != null)
                                                <video controls>
                                                    <source src="{{ asset('uploads') }}/{{ $post->file }}" type="video/mp4">
                                                </video>
                                            @endif
                                        </div>
                                        
                                        @php
                                            $uniqueUserNames = [];
                                        @endphp

                                        <div class="commented-users-name-list">
                                        <h6>Commented by :</h6>
                                        @forelse ($post->comments as $comment)
                                            @if($comment->user)
                                                @php
                                                    $userName = $comment->user->name;
                                                @endphp

                                                @if (!in_array($userName, $uniqueUserNames))
                                                    {{ $userName }},
                                                    @php
                                                        $uniqueUserNames[] = $userName;
                                                    @endphp
                                                @endif
                                    
                                            @endif
                                        @empty
                                            <p>No Comments yet.</p>
                                        @endforelse
                                       </div>
                                        
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    
                    </div>
                </div>
            </section>
            <?php //echo "<pre>"; print_r($allPostsData); ?>
   @endsection
