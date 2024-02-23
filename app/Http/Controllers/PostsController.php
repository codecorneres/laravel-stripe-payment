<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allPostsData = Posts::with('comments')->get();

        return view('posts.posts',compact('allPostsData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(){
        return view('posts.add_post');
    }
    public function create(Request $request)
    {
        if ($request->hasFile('file')) {
            
            $file = $request->file('file');
            
            $filename = $file->getClientOriginalName();
            
            $path = public_path('uploads');
            // Move the uploaded file to the specified path with the original filename
            $file->move($path, $filename);

            // Optionally, you can return a response indicating the success of the upload
            //return response()->json(['message' => 'File uploaded successfully']);

        } else {
            // Handle case where no file was uploaded
            return response()->json(['error' => 'No file uploaded'], 400);
        }
        Posts::create([
            'name' => $request->name,
            'content' => $request->content,
            'file' => $filename,
        ]);
        
        return redirect('/posts')->with('status','Data Added Successfully');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts, $id)
    {
        
        $post = Posts::with('comments')->where('id',$id)->first();
        //dd($post);
        return view('posts.single', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts,$id)
    {
        $post = Posts::find($id);
        $post->name = $request->input('name');
        $post->content = $request->input('content');

        if($post->file == null){

        // }else{
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();
                $path = public_path('uploads');
                $file->move($path, $filename);
    
                // Update the file attribute of the post
                $post->file = $filename;
    
            }
        }
        
        //$post->file = $request->file('file');
        $post->update();
       // die();
        return redirect('/posts')->with('status','Data Updated Successfully');
    }

    public function deleteFile(Request $request, $id) {
        $post = Posts::find($id);
        $post->update(['file' => null]);   
        return redirect('/single/'.$id)->with('status','File Removed Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
