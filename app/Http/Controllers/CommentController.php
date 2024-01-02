<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Posts;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        if(Auth::check()){
            $post = Posts::where('id',$request->post_id)->first();
            //$id = $post->id;
            if($post){
                Comment::create([
                    'post_id' => $post->id,
                    'user_id' => Auth::user()->id,
                    'comment_body' => $request->comment_body
                ]);
               return redirect('/posts')->with('status','Comment Added Successfully');
            }
            else{
                redirect()->back()->with('status','No such post found');
            }
        }
        else{
            redirect('login')->with('status','login first to comment');
        }
        
    }
}
