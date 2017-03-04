<?php

	//Authentication Routes
	Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', ['as' => 'logout' , 'uses' => 'Auth\AuthController@getLogout']);
	
	//Registeation routes
	Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
	Route::post('auth/register', 'Auth\AuthController@postRegister');
	
	//Password reset routes
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');
	
	// Categiries
	Route::resource('categories', 'CategoryController', ['except' => ['create']]);
	
	//Posts
	Route::resource('posts', 'PostController');
	
	//Tags
	Route::resource('tags', 'TagController');

	//Comments
	Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
	
	//Blog
	Route::get('/blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
	Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);
	Route::get('/', 'PagesController@getIndex');
	Route::get('/about', 'PagesController@getAbout');
	Route::get('/contact', 'PagesController@getContact');
	