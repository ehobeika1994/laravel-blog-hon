<?php
	
namespace App\Http\Controllers;

class PagesController extends Controller {
	
	public function getIndex()
	{
		return view('pages.welcome');
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