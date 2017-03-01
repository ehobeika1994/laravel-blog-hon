<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // create a variable and store all the blog posts fro the database
        $posts = Post::orderBy('id', 'desc')->paginate(10);
        
        // return a view and pass in the variable
        return view('posts.index', [
	        'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'body'  => 'required'
            ));

        
        // store in the database
        $post = new Post;
        
        $post->title = $request->title;
        $post->body = $request->body;
        
        $post->save();

		Session::flash('success', 'You have successfully submitted a post!');
        // redirect to another page
		return redirect()->route('posts.show', $post->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $post = Post::find($id);
	    
        return view('posts.show', [
	        'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database by id
        $post = Post::find($id);
        
        // return a view with the data inside
        return view('posts.edit', [
	       'post' => $post 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate the data
        $this->validate($request, array(
                'title' => 'required|max:255',
                'body'  => 'required'
        ));

        
        // store in the database
        $post = Post::find($id);
        
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        
        $post->save();

		Session::flash('success', 'You have successfully updated a post!');
        // redirect to another page
		return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        
        return redirect()->route('posts.index');
    }
}
