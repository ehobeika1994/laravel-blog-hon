 <!-- Default Bootstrap NavBar -->
	  	<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Laravel Blog</a>
		    </div>
		
		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
		        <li class="{{ Request::is('blog') ? 'active' : '' }}"><a href="/blog">Blog</a></li>
		        <li class="{{ Request::is('about') ? 'active' : '' }}"><a href="/about">About</a></li>
		        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact</a></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if (Auth::check()) {{ Auth::user()->name }} @else Check In @endif <span class="caret"></span></a>
		          <ul class="dropdown-menu">
			        @if (Auth::check())
		            <li><a href="{{ route('posts.index') }}">Posts</a></li>
		            <li><a href="{{ route('categories.index') }}">Category</a></li>
		            <li><a href="{{ route('tags.index') }}">Tag</a></li>
		            <li role="separator" class="divider"></li>
		            <li><a href="{{ route('logout') }}">Logout</a></li>
		            @else
		            <li><a href="{{ route('login') }}">Login</a></li>
		            <li><a href="{{ route('register') }}">Register</a></li>
		            @endif
		          </ul>
		        </li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
