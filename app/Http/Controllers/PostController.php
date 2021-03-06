<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use App\Tag;
use Purifier;
use Session;
use Image;

class PostController extends Controller
{
	
	public function __construct() 
	{
		$this->middleware('auth');
	}
	
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
	    $categories = Category::all();
	    $tags = Tag::all();
        return view('posts.create')->withCategories($categories)->withTags($tags);
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
                'title' 		=> 'required|max:255',
                'user_id' 		=> 'required|integer',
                'slug'	 		=> 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' 	=> 'required|integer',
                'body'  		=> 'required'
            ));

        
        // store in the database
        $post = new Post;
        
        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = Purifier::clean($request->body);
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        
        //save our image
        if ($request->hasFile('featured_image')) 
        {
	    	$image = $request->file('featured_image');
	    	$filename = time() . '.' . $image->getClientOriginalExtension();    
	    	$location = public_path('images/' . $filename);
	    	//save image at location
	    	Image::make($image)->resize(800, 400)->save($location);
	    	// save image in database
	    	$post->image = $filename;
        }
        
        $post->save();
        
        // save tags to post_tag_table
        $post->tags()->sync($request->tag_id, false);

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
        
        $categories = Category::all();
        $cats = [];
        foreach($categories as $category)
        {
	        $cats[$category->id] = $category->name;
	        
        }
        
        $tags = Tag::all();
		$tags2 = [];
		foreach ($tags as $tag)
		{
			$tags2[$tag->id] = $tag->name;
		}
        // return a view with the data inside
        return view('posts.edit', [
	       'post' => $post,
	       'categories' => $cats,
	       'tags' => $tags2
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
        $post = Post::find($id);
        if($request->input('slug') == $post->slug)
        {
			$this->validate($request, array(
                'title' => 'required|max:255',
                'category_id' => 'required|integer',
                'body'  => 'required'
			));
        } else {
	        $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id' => 'required|integer',                
                'body'  => 'required'
			));
        }
        
                
        // store in the database
        $post = Post::find($id);
        
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->body = Purifier::clean($request->input('body'));
        $post->category_id = $request->input('category_id');
        
        $post->save();
		
		// update tags to post_tag_table
		if(isset($request->tag_id)) {
			$post->tags()->sync($request->tag_id, true);
		} else {
			$post->tags()->sync(array());
		}
        

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
        $post->tags()->detach();
        $post->delete();
        Session::flash('success', 'The post successfully deleted');
        return redirect()->route('posts.index');
    }
}
