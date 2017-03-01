<?php
	
namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {
	
	public function getIndex()
	{
		$posts = Post::orderBy('created_at', 'desc')->limit(6)->get();
		return view('pages.welcome')->withPosts($posts);
	}
	
	public function getAbout()
	{
		$first = 'Edmond';
		$last = 'Hobeika';
		$full = $first . " " . $last;
		
		$email = 'edmondhobeika@gmail.com';
		return view('pages.about', [
			'fullname' => $full,
			'email' => $email
		]);
	}

	public function getContact()
	{
		return view('pages.contact');
	}
}