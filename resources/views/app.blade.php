<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Test.ru</title>

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/myapp.css') }}" rel="stylesheet">
    <link href="{{ asset('/jquery/funcybox/jquery.fancybox.css') }}" rel="stylesheet">
    <link href="{{ asset('/jquery/funcybox/jquery.fancybox-buttons.css') }}" rel="stylesheet">
    <link href="{{ asset('/jquery/funcybox/jquery.fancybox-thumbs.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
                    <li><a href="{{ url('/') }}">Logo</a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Shoping Cart</a></li>
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
                    @elseif(Auth::checkAdmin())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <li><a href="{{ url('/cart/get-product') }}">Shoping Cart<br/>Count: <span id="quantity" >
                                    @if(count(Session::get('productId'))!==0)
                                        {{count(Session::get('productId'))}}
                                        </span> <br/>Sum: <span id="sum" >{{Product::price(Session::get('productId'))}}</span> $</a></li>
                                    @else
                                        0
                                        </span> <br/>Sum: <span id="sum" > 0 </span> $</a></li>
                                    @endif


                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/admin') }}">Categories</a></li>
                            <li><a href="{{ url('/product') }}">Products</a></li>
                            <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                        </ul>
					@else
                        <li><a href="{{ url('/auth/login') }}">Shoping Cart</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ asset('/jquery/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/multiple.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/jquery.fancybox.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/jquery.fancybox-buttons.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/jquery.fancybox-media.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/jquery.fancybox-thumbs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/funcybox/jquery.mousewheel-3.0.6.pack.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/evevatezoom/jquery.elevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/myelevatezoom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/jquery/lodash/lodash.js') }}"></script>

    @yield('scripts')


</body>
</html>
